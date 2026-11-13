<?php
/**
 * Blog bilingüe con Polylang.
 *
 * Cada nota es un post de WordPress con su idioma (ES o EN), y las versiones
 * de una misma nota se vinculan como traducciones desde el editor (caja
 * "Idiomas" de Polylang). Una nota puede existir en un solo idioma.
 * Polylang filtra automáticamente las consultas por el idioma actual.
 *
 * Migración: hasta la v1 la versión en inglés se guardaba en los meta
 * `es_title_en` / `es_content_en` del post en español. Si un post todavía
 * tiene esos datos, se muestran en una caja de sólo lectura para copiarlos
 * a la traducción en inglés. Una vez copiados, se pueden borrar con el
 * checkbox de esa caja.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'ES_META_TITLE_EN',   'es_title_en' );
define( 'ES_META_CONTENT_EN', 'es_content_en' );

function es_blog_legacy_has_en( $post_id ) {
    return get_post_meta( $post_id, ES_META_TITLE_EN, true ) !== ''
        || get_post_meta( $post_id, ES_META_CONTENT_EN, true ) !== '';
}

function es_blog_add_legacy_metabox( $post_type, $post ) {
    if ( 'post' !== $post_type || ! $post || ! es_blog_legacy_has_en( $post->ID ) ) {
        return;
    }
    add_meta_box(
        'es-en-legacy',
        __( 'Versión en inglés anterior (para migrar)', 'eduardo-seelig' ),
        'es_blog_render_legacy_metabox',
        'post',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'es_blog_add_legacy_metabox', 10, 2 );

function es_blog_render_legacy_metabox( $post ) {
    wp_nonce_field( 'es_blog_legacy', 'es_blog_legacy_nonce' );
    ?>
    <p>Este post tiene la versión en inglés guardada con el sistema anterior, que ya no se muestra en el sitio.
       Creá la traducción en inglés desde la caja <strong>Idiomas</strong> (botón “+” junto a English), copiá ahí
       el título y el contenido, y después borrá estos datos.</p>
    <p><label style="display:block;font-weight:600;margin-bottom:4px;">Title (EN)</label>
        <input type="text" class="widefat" readonly value="<?php echo esc_attr( get_post_meta( $post->ID, ES_META_TITLE_EN, true ) ); ?>"></p>
    <p><label style="display:block;font-weight:600;margin-bottom:4px;">Content (EN)</label>
        <textarea rows="10" class="widefat" readonly><?php echo esc_textarea( get_post_meta( $post->ID, ES_META_CONTENT_EN, true ) ); ?></textarea></p>
    <p><label><input type="checkbox" name="es_blog_legacy_delete" value="1"> Ya lo copié: borrar estos datos al guardar</label></p>
    <?php
}

function es_blog_save_legacy_metabox( $post_id ) {
    if ( empty( $_POST['es_blog_legacy_delete'] )
        || ! isset( $_POST['es_blog_legacy_nonce'] )
        || ! wp_verify_nonce( $_POST['es_blog_legacy_nonce'], 'es_blog_legacy' )
        || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        || ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    delete_post_meta( $post_id, ES_META_TITLE_EN );
    delete_post_meta( $post_id, ES_META_CONTENT_EN );
}
add_action( 'save_post_post', 'es_blog_save_legacy_metabox' );
