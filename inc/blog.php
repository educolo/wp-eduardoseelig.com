<?php
/**
 * Blog bilingüe (MVP, sin plugins).
 *
 * El sitio usa un sistema de idiomas propio: se imprimen ES y EN juntos en el
 * HTML (envueltos en .i18n data-lang) y el JS del tema muestra uno solo.
 * Para los posts extendemos ese mismo modelo: la versión en español es el
 * contenido nativo del post; la versión en inglés se guarda en dos campos
 * meta editables desde un meta box. Si el inglés está vacío, se hace fallback
 * al español (podés publicar en español y traducir después).
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'ES_META_TITLE_EN',   'es_title_en' );
define( 'ES_META_CONTENT_EN', 'es_content_en' );

/* ---------------------------------------------------------------------------
 * Meta box: versión en inglés
 * ------------------------------------------------------------------------- */
function es_blog_add_metabox() {
    add_meta_box(
        'es-en-version',
        __( 'Versión en inglés (EN)', 'eduardo-seelig' ),
        'es_blog_render_metabox',
        'post',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'es_blog_add_metabox' );

function es_blog_render_metabox( $post ) {
    wp_nonce_field( 'es_blog_save_en', 'es_blog_en_nonce' );
    $title_en   = get_post_meta( $post->ID, ES_META_TITLE_EN, true );
    $content_en = get_post_meta( $post->ID, ES_META_CONTENT_EN, true );
    ?>
    <p>
        <label for="es_title_en" style="display:block;font-weight:600;margin-bottom:4px;">Title (EN)</label>
        <input type="text" id="es_title_en" name="es_title_en" class="widefat"
               value="<?php echo esc_attr( $title_en ); ?>"
               placeholder="English title (opcional)">
    </p>
    <p style="margin-top:14px;">
        <label for="es_content_en" style="display:block;font-weight:600;margin-bottom:4px;">Content (EN)</label>
        <textarea id="es_content_en" name="es_content_en" rows="14" class="widefat"
                  placeholder="English content (opcional). Podés usar HTML básico; las líneas en blanco se convierten en párrafos."><?php echo esc_textarea( $content_en ); ?></textarea>
    </p>
    <p class="description">
        Si dejás estos campos vacíos, el sitio muestra la versión en español en ambos idiomas (fallback).
    </p>
    <?php
}

function es_blog_save_metabox( $post_id ) {
    if ( ! isset( $_POST['es_blog_en_nonce'] ) || ! wp_verify_nonce( $_POST['es_blog_en_nonce'], 'es_blog_save_en' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( isset( $_POST['es_title_en'] ) ) {
        update_post_meta( $post_id, ES_META_TITLE_EN, sanitize_text_field( wp_unslash( $_POST['es_title_en'] ) ) );
    }
    if ( isset( $_POST['es_content_en'] ) ) {
        update_post_meta( $post_id, ES_META_CONTENT_EN, wp_kses_post( wp_unslash( $_POST['es_content_en'] ) ) );
    }
}
add_action( 'save_post_post', 'es_blog_save_metabox' );

/* ---------------------------------------------------------------------------
 * Helpers de render bilingüe (con fallback al español)
 * ------------------------------------------------------------------------- */

/** Título del post en ambos idiomas. Devuelve ['es' => ..., 'en' => ...]. */
function es_post_titles( $post = null ) {
    $post = get_post( $post );
    $es   = get_the_title( $post );
    $en   = get_post_meta( $post->ID, ES_META_TITLE_EN, true );
    return [ 'es' => $es, 'en' => ( $en !== '' ? $en : $es ) ];
}

/** Contenido HTML del post en ambos idiomas (ya filtrado/seguro para imprimir). */
function es_post_contents( $post = null ) {
    $post   = get_post( $post );
    $es     = apply_filters( 'the_content', $post->post_content );
    $en_raw = get_post_meta( $post->ID, ES_META_CONTENT_EN, true );
    $en     = $en_raw !== '' ? wpautop( $en_raw ) : $es;
    return [ 'es' => $es, 'en' => $en ];
}

/** Extracto corto del post en ambos idiomas (para las cards del listado/home). */
function es_post_excerpts( $post = null ) {
    $post   = get_post( $post );
    $es     = get_the_excerpt( $post );
    $en_raw = get_post_meta( $post->ID, ES_META_CONTENT_EN, true );
    $en     = $en_raw !== '' ? wp_trim_words( wp_strip_all_tags( $en_raw ), 32, '…' ) : $es;
    return [ 'es' => $es, 'en' => $en ];
}

/**
 * Imprime un bloque HTML en los dos idiomas, envuelto en .i18n para que el
 * toggle del tema (assets/js/main.js) muestre uno solo. A diferencia de
 * es_t(), NO escapa: usar solo con HTML ya saneado (the_content / wpautop).
 */
function es_print_bilingual_html( $es_html, $en_html, $wrap = 'div', $class = '' ) {
    printf( '<%1$s class="i18n %3$s" data-lang="es">%2$s</%1$s>', esc_attr( $wrap ), $es_html, esc_attr( $class ) );
    printf( '<%1$s class="i18n %3$s" data-lang="en" hidden>%2$s</%1$s>', esc_attr( $wrap ), $en_html, esc_attr( $class ) );
}
