<?php
/**
 * Sistema de bilingüe ES/EN, igual de simple que el original (sin recargar
 * página: los dos idiomas se imprimen en el HTML y JS muestra uno solo,
 * guardando la preferencia en localStorage).
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Devuelve el string en un idioma para uso donde no se puede imprimir HTML
 * (ej. dentro de un atributo, o el <title>). Usa el idioma por defecto (es).
 */
function es_pick( $valor, $lang = 'es' ) {
    if ( is_array( $valor ) && isset( $valor['es'] ) ) {
        return $valor[ $lang ] ?? $valor['es'];
    }
    return $valor;
}

/**
 * Imprime un valor bilingüe como dos <span> (uno por idioma). El JS del
 * tema (assets/js/main.js) oculta el que no corresponde según el idioma
 * activo. $tag permite envolver en otro elemento que no sea <span>.
 */
function es_t( $valor, $tag = 'span', $class = '' ) {
    if ( is_array( $valor ) && isset( $valor['es'] ) ) {
        printf(
            '<%1$s class="i18n %3$s" data-lang="es">%2$s</%1$s><%1$s class="i18n %3$s" data-lang="en" hidden>%4$s</%1$s>',
            esc_attr( $tag ),
            esc_html( $valor['es'] ),
            esc_attr( $class ),
            esc_html( $valor['en'] )
        );
    } else {
        echo esc_html( $valor );
    }
}

/** Igual que es_t() pero permite HTML dentro (usar con cuidado, contenido propio). */
function es_t_html( $valor, $tag = 'span', $class = '' ) {
    if ( is_array( $valor ) && isset( $valor['es'] ) ) {
        printf(
            '<%1$s class="i18n %3$s" data-lang="es">%2$s</%1$s><%1$s class="i18n %3$s" data-lang="en" hidden>%4$s</%1$s>',
            esc_attr( $tag ),
            $valor['es'],
            esc_attr( $class ),
            $valor['en']
        );
    } else {
        echo $valor;
    }
}

/**
 * Imprime una lista bilingüe (array de items, cada uno posiblemente
 * bilingüe) como dos <ul>/<ol> completos, uno por idioma.
 * $render_item recibe ($item, $lang) y debe hacer echo del <li>...</li>.
 */
function es_t_list( $valor_es, $valor_en, $wrapper_tag, $wrapper_class, $render_item ) {
    echo '<' . esc_attr( $wrapper_tag ) . ' class="i18n ' . esc_attr( $wrapper_class ) . '" data-lang="es">';
    foreach ( $valor_es as $item ) { $render_item( $item ); }
    echo '</' . esc_attr( $wrapper_tag ) . '>';

    echo '<' . esc_attr( $wrapper_tag ) . ' class="i18n ' . esc_attr( $wrapper_class ) . '" data-lang="en" hidden>';
    foreach ( $valor_en as $item ) { $render_item( $item ); }
    echo '</' . esc_attr( $wrapper_tag ) . '>';
}

/** Trae un string de ui-strings.php por ruta tipo "nav.enfoque", en los dos idiomas envueltos. */
function es_ui_t( $path, $tag = 'span', $class = '' ) {
    $ui = es_ui();
    $keys = explode( '.', $path );
    $es_v = $ui['es']; $en_v = $ui['en'];
    foreach ( $keys as $k ) { $es_v = $es_v[ $k ] ?? ''; $en_v = $en_v[ $k ] ?? ''; }
    es_t( [ 'es' => $es_v, 'en' => $en_v ], $tag, $class );
}

/** Igual que es_ui_t pero devuelve el string plano (es) — para usar en <title>, alt, etc. */
function es_ui_get( $path, $lang = 'es' ) {
    $ui = es_ui();
    $keys = explode( '.', $path );
    $v = $ui[ $lang ];
    foreach ( $keys as $k ) { $v = $v[ $k ] ?? ''; }
    return $v;
}
