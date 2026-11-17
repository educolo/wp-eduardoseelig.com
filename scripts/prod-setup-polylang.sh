#!/usr/bin/env bash
#
# Configuración única de Polylang en producción (Hostinger), vía WP-CLI.
# Se corre en el servidor, desde tu máquina:
#
#   ssh -p <puerto> <usuario>@<host> 'bash -s' < scripts/prod-setup-polylang.sh
#
# Requisito: el tema >= 1.1.0 (con soporte Polylang) ya desplegado.
# Es idempotente: si algo ya está hecho, lo saltea.
#
# Rollback (si algo sale mal):
#   cd ~/domains/eduardoseelig.com/public_html
#   wp db import ~/backups/<archivo>.sql && wp plugin deactivate polylang && wp litespeed-purge all
#
set -euo pipefail

WP_PATH="${WP_PATH:-$HOME/domains/eduardoseelig.com/public_html}"
# Notas que ya existen en los dos idiomas: "id_es:id_en" separados por espacio.
TRANSLATED_POSTS="${TRANSLATED_POSTS:-1470:1472}"
MIN_THEME_VERSION="1.1.0"

cd "$WP_PATH"

echo "==> 0. Chequeos previos"
theme_version="$(wp theme get eduardo-seelig --field=version)"
if ! wp eval "exit( version_compare( '$theme_version', '$MIN_THEME_VERSION', '>=' ) ? 0 : 1 );"; then
  echo "ERROR: el tema está en $theme_version; hace falta >= $MIN_THEME_VERSION desplegado antes." >&2
  exit 1
fi
echo "    Tema $theme_version OK"

echo "==> 1. Backup de la base"
# SKIP_BACKUP=1 solo para probar el script en el Docker local (sin mysqldump).
backup="(sin backup)"
if [ "${SKIP_BACKUP:-0}" != "1" ]; then
  mkdir -p "$HOME/backups"
  backup="$HOME/backups/eduardoseelig-pre-polylang-$(date +%Y%m%d-%H%M%S).sql"
  # mysqldump directo: en Hostinger `wp db export` sale con 255 sin error.
  # Las credenciales van a un archivo temporal 600, no a la línea de comandos.
  cnf="$(umask 077 && mktemp)"
  trap 'rm -f "$cnf"' EXIT
  printf '[client]\nuser=%s\npassword=%s\nhost=%s\n' \
    "$(wp config get DB_USER)" "$(wp config get DB_PASSWORD)" "$(wp config get DB_HOST)" > "$cnf"
  mysqldump --defaults-extra-file="$cnf" --single-transaction --no-tablespaces \
    "$(wp config get DB_NAME)" > "$backup"
  rm -f "$cnf"
  echo "    $backup ($(du -h "$backup" | cut -f1))"
fi

echo "==> 2. Idioma es_AR (traducciones de WordPress: fechas, etc.)"
wp language core install es_AR --quiet || true

echo "==> 3. Polylang"
wp plugin is-installed polylang || wp plugin install polylang --quiet
wp plugin activate polylang --quiet || true

echo "==> 4. Idiomas, ajustes, contenido y páginas EN"
TRANSLATED_POSTS="$TRANSLATED_POSTS" wp eval '
$check = function ( $result, $what ) {
    if ( is_wp_error( $result ) && $result->has_errors() ) {
        WP_CLI::error( "$what: " . $result->get_error_message() );
    }
    if ( ! $result ) {
        WP_CLI::error( "$what: falló sin detalle" );
    }
    return $result;
};
if ( ! function_exists( "PLL" ) || ! function_exists( "pll_set_post_language" ) ) {
    WP_CLI::error( "Polylang no está cargado" );
}

// Idiomas: español primero (queda por defecto), después inglés.
$m = PLL()->model;
if ( ! $m->languages->get( "es" ) ) {
    $check( $m->languages->add( [ "locale" => "es_AR", "slug" => "es", "name" => "Español", "flag" => "ar", "term_group" => 0 ] ), "Agregar idioma es" );
    WP_CLI::log( "    Idioma es creado" );
}
if ( ! $m->languages->get( "en" ) ) {
    $check( $m->languages->add( [ "locale" => "en_US", "slug" => "en", "name" => "English", "flag" => "us", "term_group" => 1 ] ), "Agregar idioma en" );
    WP_CLI::log( "    Idioma en creado" );
}

// Ajustes de URL y detección del navegador.
$o = PLL()->options;
foreach ( [
    "default_lang" => "es",
    "force_lang"   => 1,     // idioma desde el directorio (/en/)
    "hide_default" => true,  // sin /es/ para el idioma por defecto
    "rewrite"      => true,  // /en/ y no /language/en/
    "browser"      => true,  // detectar idioma del navegador en la home
] as $key => $value ) {
    $errors = $o->set( $key, $value );
    if ( $errors->has_errors() ) {
        WP_CLI::error( "Opción $key: " . $errors->get_error_message() );
    }
}
$o->save();
WP_CLI::log( "    Ajustes guardados" );

// Todo el contenido sin idioma pasa a español.
$n = 0;
foreach ( get_posts( [ "post_type" => [ "post", "page" ], "post_status" => "any", "numberposts" => -1, "fields" => "ids" ] ) as $id ) {
    if ( ! pll_get_post_language( $id ) ) {
        pll_set_post_language( $id, "es" );
        $n++;
    }
}
WP_CLI::log( "    $n posts/páginas marcados como español" );

// Notas que ya existen en los dos idiomas: marcar la EN y vincularlas.
foreach ( array_filter( explode( " ", getenv( "TRANSLATED_POSTS" ) ) ) as $pair ) {
    list( $es_id, $en_id ) = array_map( "intval", explode( ":", $pair ) );
    if ( ! get_post( $es_id ) || ! get_post( $en_id ) ) {
        WP_CLI::error( "No existe el post $es_id o $en_id" );
    }
    pll_set_post_language( $es_id, "es" );
    pll_set_post_language( $en_id, "en" );
    pll_save_post_translations( [ "es" => $es_id, "en" => $en_id ] );
    WP_CLI::log( "    Vinculadas: $es_id (es) <-> $en_id (en)" );
}

// Campos del sistema anterior que quedaron vacíos (si tienen datos, se
// conservan para la caja de migración del editor).
$n = 0;
foreach ( get_posts( [ "post_type" => "post", "post_status" => "any", "numberposts" => -1, "fields" => "ids" ] ) as $id ) {
    foreach ( [ "es_title_en", "es_content_en" ] as $key ) {
        if ( metadata_exists( "post", $id, $key ) && "" === get_post_meta( $id, $key, true ) ) {
            delete_post_meta( $id, $key );
            $n++;
        }
    }
}
WP_CLI::log( "    $n campos vacíos del sistema anterior borrados" );

// Páginas EN (misma plantilla, slug propio: Polylang gratis no comparte slugs).
$pages = [ "cv" => [ "resume", "Resume", "page-cv.php" ], "blog" => [ "posts", "Posts", "page-blog.php" ] ];
foreach ( $pages as $es_slug => list( $en_slug, $en_title, $tpl ) ) {
    $es = get_page_by_path( $es_slug );
    if ( ! $es ) {
        WP_CLI::error( "No existe la página $es_slug" );
    }
    if ( pll_get_post( $es->ID, "en" ) ) {
        WP_CLI::log( "    Página EN de $es_slug ya existe" );
        continue;
    }
    $en_id = $check( wp_insert_post( [ "post_type" => "page", "post_status" => "publish", "post_title" => $en_title, "post_name" => $en_slug ], true ), "Crear página $en_slug" );
    update_post_meta( $en_id, "_wp_page_template", $tpl );
    pll_set_post_language( $en_id, "en" );
    pll_save_post_translations( [ "es" => $es->ID, "en" => $en_id ] );
    WP_CLI::log( "    Página EN creada: /en/" . get_post_field( "post_name", $en_id ) . "/" );
}

// Verificación final.
if ( [ "es", "en" ] !== pll_languages_list() ) {
    WP_CLI::error( "Idiomas inesperados: " . implode( ",", pll_languages_list() ) );
}
foreach ( array_keys( $pages ) as $es_slug ) {
    if ( ! pll_get_post( get_page_by_path( $es_slug )->ID, "en" ) ) {
        WP_CLI::error( "La página $es_slug no tiene traducción EN" );
    }
}
WP_CLI::success( "Polylang configurado" );
'

echo "==> 5. Enlaces permanentes y caché"
# Sin --hard: no reescribir .htaccess (LiteSpeed tiene reglas propias ahí).
wp rewrite flush --quiet
if wp plugin is-active litespeed-cache; then
  wp litespeed-purge all
fi

echo ""
echo "Listo. Backup: $backup"
