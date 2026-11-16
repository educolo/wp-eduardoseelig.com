<?php
/**
 * Sistema bilingüe ES/EN sobre Polylang.
 *
 * Polylang define el idioma de cada request por la URL (/ = español,
 * /en/ = inglés) y maneja los posts/páginas como traducciones separadas.
 * Estos helpers sólo deciden qué variante imprimir de los textos fijos del
 * tema (inc/site-content.php e inc/ui-strings.php), que siguen definidos
 * como arrays ['es' => ..., 'en' => ...].
 *
 * Si Polylang no está activo, todo cae a español sin romper el sitio.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'ES_LANGS', [ 'es', 'en' ] );
define( 'ES_DEFAULT_LANG', 'es' );

/** Idioma actual del request ('es' o 'en'). */
function es_lang() {
    if ( function_exists( 'pll_current_language' ) ) {
        $lang = pll_current_language( 'slug' );
        if ( in_array( $lang, ES_LANGS, true ) ) {
            return $lang;
        }
    }
    return ES_DEFAULT_LANG;
}

/**
 * Devuelve la variante de un valor bilingüe en el idioma pedido (por
 * defecto, el actual). Si el valor no es bilingüe, lo devuelve tal cual.
 */
function es_pick( $valor, $lang = null ) {
    if ( is_array( $valor ) && isset( $valor['es'] ) ) {
        $lang = $lang ?: es_lang();
        return $valor[ $lang ] ?? $valor[ ES_DEFAULT_LANG ];
    }
    return $valor;
}

/** Imprime un valor bilingüe (escapado) en el idioma actual, envuelto en $tag. */
function es_t( $valor, $tag = 'span', $class = '' ) {
    printf(
        '<%1$s%3$s>%2$s</%1$s>',
        esc_attr( $tag ),
        esc_html( es_pick( $valor ) ),
        $class !== '' ? ' class="' . esc_attr( $class ) . '"' : ''
    );
}

/** Igual que es_t() pero permite HTML dentro (usar sólo con contenido propio). */
function es_t_html( $valor, $tag = 'span', $class = '' ) {
    printf(
        '<%1$s%3$s>%2$s</%1$s>',
        esc_attr( $tag ),
        es_pick( $valor ),
        $class !== '' ? ' class="' . esc_attr( $class ) . '"' : ''
    );
}

/**
 * Imprime una lista en el idioma actual. $render_item recibe cada item y
 * debe hacer echo del <li>...</li>.
 */
function es_t_list( $valor_es, $valor_en, $wrapper_tag, $wrapper_class, $render_item ) {
    $items = es_lang() === 'en' ? $valor_en : $valor_es;
    echo '<' . esc_attr( $wrapper_tag ) . ' class="' . esc_attr( $wrapper_class ) . '">';
    foreach ( $items as $item ) { $render_item( $item ); }
    echo '</' . esc_attr( $wrapper_tag ) . '>';
}

/** Imprime un string de ui-strings.php por ruta tipo "nav.enfoque", en el idioma actual. */
function es_ui_t( $path, $tag = 'span', $class = '' ) {
    es_t( es_ui_get( $path ), $tag, $class );
}

/** Devuelve un string plano de ui-strings.php (por defecto en el idioma actual). */
function es_ui_get( $path, $lang = null ) {
    $ui = es_ui();
    $v  = $ui[ $lang ?: es_lang() ];
    foreach ( explode( '.', $path ) as $k ) { $v = $v[ $k ] ?? ''; }
    return $v;
}

/* ---------------------------------------------------------------------------
 * URLs en el idioma actual
 * ------------------------------------------------------------------------- */

/** Ancla (id) de una sección de la home en el idioma actual: es_anchor( 'focus' ) => "enfoque" en español. */
function es_anchor( $section, $lang = null ) {
    return es_ui_get( 'anchors.' . $section, $lang ) ?: $section;
}

/**
 * Home de un idioma (por defecto, el actual), opcionalmente apuntando a una
 * sección: es_home_url( 'focus' ) => "/#enfoque" en español, "/en/#focus" en inglés.
 */
function es_home_url( $section = '', $lang = null ) {
    $lang = $lang ?: es_lang();
    $url  = function_exists( 'pll_home_url' ) ? pll_home_url( $lang ) : home_url( '/' );
    return $section !== '' ? $url . '#' . es_anchor( $section, $lang ) : $url;
}

/**
 * URL de una página del tema (por su slug en español: "blog", "cv") en un
 * idioma (por defecto, el actual). Si la página no tiene traducción, devuelve
 * la española; si la página no existe, la home de ese idioma. Se calcula una
 * vez por request (el header, el footer y las plantillas la piden varias veces).
 */
function es_page_url( $slug, $lang = null ) {
    static $cache = [];
    $lang = $lang ?: es_lang();
    if ( isset( $cache[ $lang ][ $slug ] ) ) {
        return $cache[ $lang ][ $slug ];
    }
    $page = get_page_by_path( $slug );
    if ( ! $page ) {
        $url = es_home_url( '', $lang );
    } else {
        $id = $page->ID;
        if ( function_exists( 'pll_get_post' ) ) {
            $id = pll_get_post( $id, $lang ) ?: $id;
        }
        $url = get_permalink( $id );
    }
    return $cache[ $lang ][ $slug ] = $url;
}

/** Parámetro que indica que el visitante llegó desde una página sin traducción. */
define( 'ES_UNTRANSLATED_PARAM', 'untranslated' );

/**
 * Links del selector de idioma: [ ['slug' => 'es', 'name' => 'Español', 'url' => ..., 'current' => bool], ... ].
 * Cada link apunta a la traducción de la página actual. Si no existe, en una
 * nota lleva al blog del otro idioma y en cualquier otra página a su home,
 * con ?untranslated=1 para mostrar un aviso (ver template-parts/untranslated-notice.php).
 */
function es_lang_links() {
    if ( function_exists( 'pll_the_languages' ) ) {
        $raw = pll_the_languages( [ 'raw' => 1, 'hide_if_empty' => 0 ] );
        if ( is_array( $raw ) && $raw ) {
            return array_map( function ( $l ) {
                $url = $l['url'];
                if ( ! empty( $l['no_translation'] ) && empty( $l['current_lang'] ) ) {
                    $target = is_singular( 'post' ) ? es_page_url( 'blog', $l['slug'] ) : es_home_url( '', $l['slug'] );
                    $url    = add_query_arg( ES_UNTRANSLATED_PARAM, '1', $target );
                }
                return [ 'slug' => $l['slug'], 'name' => $l['name'], 'url' => $url, 'current' => ! empty( $l['current_lang'] ) ];
            }, array_values( $raw ) );
        }
    }
    return [ [ 'slug' => 'es', 'name' => 'Español', 'url' => home_url( '/' ), 'current' => true ] ];
}

/** ¿El visitante llegó desde una página que no tiene traducción a este idioma? */
function es_is_untranslated_redirect() {
    return ! empty( $_GET[ ES_UNTRANSLATED_PARAM ] ); // phpcs:ignore WordPress.Security.NonceVerification
}
