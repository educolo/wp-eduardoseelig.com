#!/bin/sh
#
# Instalacion automatica de WordPress + activacion del tema Eduardo Seelig.
# Se ejecuta una sola vez desde el servicio "wpcli". Es idempotente: si ya
# esta instalado, no vuelve a crear nada.
#
set -eu

WP_URL="${WP_URL:-http://localhost:8080}"
SITE_TITLE="${SITE_TITLE:-Eduardo Seelig (local)}"
ADMIN_USER="${ADMIN_USER:-admin}"
ADMIN_PASS="${ADMIN_PASS:-admin}"
ADMIN_EMAIL="${ADMIN_EMAIL:-admin@example.com}"

cd /var/www/html

echo "==> Esperando a que WordPress copie sus archivos y genere wp-config.php..."
until [ -f /var/www/html/wp-load.php ] && [ -f /var/www/html/wp-config.php ]; do
  sleep 2
done

echo "==> Esperando a la base de datos..."
# La imagen wordpress:cli no trae el cliente mysql, asi que verificamos la
# conexion con mysqli via PHP (host:puerto viene en WORDPRESS_DB_HOST).
DB_HOST_ONLY="${WORDPRESS_DB_HOST%%:*}"
DB_PORT="${WORDPRESS_DB_HOST##*:}"
[ "$DB_PORT" = "$WORDPRESS_DB_HOST" ] && DB_PORT=3306
until php -r 'exit(@mysqli_connect($argv[1],$argv[2],$argv[3],"",(int)$argv[4])?0:1);' \
      "$DB_HOST_ONLY" "$WORDPRESS_DB_USER" "$WORDPRESS_DB_PASSWORD" "$DB_PORT" 2>/dev/null; do
  sleep 2
done

if ! wp core is-installed --allow-root >/dev/null 2>&1; then
  echo "==> Instalando WordPress..."
  wp core install \
    --url="$WP_URL" \
    --title="$SITE_TITLE" \
    --admin_user="$ADMIN_USER" \
    --admin_password="$ADMIN_PASS" \
    --admin_email="$ADMIN_EMAIL" \
    --skip-email \
    --allow-root
else
  echo "==> WordPress ya estaba instalado."
fi

echo "==> Activando el tema eduardo-seelig..."
wp theme activate eduardo-seelig --allow-root

# Crea (si no existe) una pagina con slug + plantilla y devuelve el ID.
ensure_page() {
  local slug="$1" title="$2" template="$3" id
  id="$(wp post list --post_type=page --name="$slug" --field=ID --allow-root | head -n1)"
  if [ -z "$id" ]; then
    echo "==> Creando pagina '$slug'..."
    id="$(wp post create --post_type=page --post_status=publish \
      --post_title="$title" --post_name="$slug" --porcelain --allow-root)"
  else
    echo "==> Pagina '$slug' ya existe (ID $id)."
  fi
  wp post meta update "$id" _wp_page_template "$template" --allow-root >/dev/null
}

ensure_page "cv" "CV" "page-cv.php"
ensure_page "blog" "Blog" "page-blog.php"

# Post de ejemplo (solo la primera vez) para que el blog no arranque vacío.
if [ -z "$(wp post list --post_type=post --field=ID --allow-root | head -n1)" ]; then
  echo "==> Creando post de ejemplo del blog..."
  wp post create --post_type=post --post_status=publish \
    --post_title="Hola, blog" \
    --post_content="<p>Primer apunte del blog. Pronto voy a ir sumando notas sobre ingeniería de software, producto e IA.</p>" \
    --allow-root >/dev/null
fi

# Home estatica (el tema usa front-page.php igual, pero dejamos permalinks lindos)
echo "==> Configurando permalinks..."
wp rewrite structure '/%postname%/' --hard --allow-root >/dev/null 2>&1 || true
wp option update show_on_front posts --allow-root >/dev/null 2>&1 || true

# ---------------------------------------------------------------------------
# Idiomas (Polylang): ES por defecto sin prefijo (/), EN en /en/, deteccion
# del idioma del navegador en la primera visita a la home.
# En produccion esto se configura a mano desde el admin (ver README).
# ---------------------------------------------------------------------------
echo "==> Instalando idioma es_AR y Polylang..."
wp language core install es_AR --allow-root >/dev/null 2>&1 || true
wp plugin is-installed polylang --allow-root || wp plugin install polylang --allow-root
wp plugin activate polylang --allow-root >/dev/null

echo "==> Configurando Polylang..."
wp eval --allow-root '
$m = PLL()->model;
if ( ! $m->languages->get( "es" ) ) {
    $m->languages->add( [ "locale" => "es_AR", "slug" => "es", "name" => "Español", "flag" => "ar", "term_group" => 0 ] );
}
if ( ! $m->languages->get( "en" ) ) {
    $m->languages->add( [ "locale" => "en_US", "slug" => "en", "name" => "English", "flag" => "us", "term_group" => 1 ] );
}
$o = PLL()->options;
$o->set( "default_lang", "es" );
$o->set( "force_lang", 1 );        // idioma desde el directorio (/en/)
$o->set( "hide_default", true );   // sin /es/ para el idioma por defecto
$o->set( "rewrite", true );        // /en/ y no /language/en/
$o->set( "browser", true );        // detectar idioma del navegador en la home
$o->save();

// Todo el contenido sin idioma pasa a ES (incluye el post de ejemplo y las paginas).
foreach ( get_posts( [ "post_type" => [ "post", "page" ], "post_status" => "any", "numberposts" => -1, "fields" => "ids" ] ) as $id ) {
    if ( ! pll_get_post_language( $id ) ) {
        pll_set_post_language( $id, "es" );
    }
}

// Traducciones EN de las paginas del tema (mismo template, slug propio:
// Polylang gratis no permite el mismo slug en dos idiomas).
$pages = [ "cv" => [ "resume", "Resume", "page-cv.php" ], "blog" => [ "notes", "Notes", "page-blog.php" ] ];
foreach ( $pages as $es_slug => list( $en_slug, $en_title, $tpl ) ) {
    $es = get_page_by_path( $es_slug );
    if ( ! $es || pll_get_post( $es->ID, "en" ) ) {
        continue;
    }
    $en_id = wp_insert_post( [ "post_type" => "page", "post_status" => "publish", "post_title" => $en_title, "post_name" => $en_slug ] );
    update_post_meta( $en_id, "_wp_page_template", $tpl );
    pll_set_post_language( $en_id, "en" );
    pll_save_post_translations( [ "es" => $es->ID, "en" => $en_id ] );
    echo "Pagina EN creada: /en/$en_slug/\n";
}
'
wp rewrite flush --hard --allow-root >/dev/null 2>&1 || true

echo ""
echo "======================================================================"
echo "  Listo. WordPress corriendo en: $WP_URL"
echo "  Admin:  $WP_URL/wp-admin   ->  usuario: $ADMIN_USER  pass: $ADMIN_PASS"
echo "======================================================================"
