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

/** Home del idioma actual (/ o /en/), con un ancla opcional ("#enfoque"). */
function es_home_url( $anchor = '' ) {
    $url = function_exists( 'pll_home_url' ) ? pll_home_url( es_lang() ) : home_url( '/' );
    return $url . $anchor;
}

/**
 * URL de una página del tema (por su slug en español: "blog", "cv") en el
 * idioma actual. Si la página no tiene traducción, devuelve la española.
 */
function es_page_url( $slug ) {
    $page = get_page_by_path( $slug );
    if ( ! $page ) {
        return home_url( '/' . $slug . '/' );
    }
    $id = $page->ID;
    if ( function_exists( 'pll_get_post' ) ) {
        $id = pll_get_post( $id, es_lang() ) ?: $id;
    }
    return get_permalink( $id );
}

/**
 * Links del selector de idioma: [ ['slug' => 'es', 'url' => ..., 'current' => bool], ... ].
 * Cada link apunta a la traducción de la página actual; si no existe,
 * Polylang devuelve la home de ese idioma.
 */
function es_lang_links() {
    if ( function_exists( 'pll_the_languages' ) ) {
        $raw = pll_the_languages( [ 'raw' => 1, 'hide_if_empty' => 0 ] );
        if ( is_array( $raw ) && $raw ) {
            return array_map( function ( $l ) {
                return [ 'slug' => $l['slug'], 'url' => $l['url'], 'current' => ! empty( $l['current_lang'] ) ];
            }, array_values( $raw ) );
        }
    }
    return [ [ 'slug' => 'es', 'url' => home_url( '/' ), 'current' => true ] ];
}
