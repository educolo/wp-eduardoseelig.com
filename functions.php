<?php
/**
 * Eduardo Seelig — tema WordPress a medida.
 * Migración del sitio original (React/Vite) manteniendo el mismo diseño.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'ES_THEME_VERSION', '1.0.0' );
define( 'ES_THEME_DIR', get_template_directory() );
define( 'ES_THEME_URI', get_template_directory_uri() );

require_once ES_THEME_DIR . '/inc/site-content.php';
require_once ES_THEME_DIR . '/inc/ui-strings.php';
require_once ES_THEME_DIR . '/inc/i18n.php';

/** Setup del tema */
function es_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'custom-logo' );

    register_nav_menus( [
        'primary' => __( 'Menú principal', 'eduardo-seelig' ),
    ] );
}
add_action( 'after_setup_theme', 'es_theme_setup' );

/** Estilos y scripts */
function es_theme_assets() {
    // Fuentes de Google (mismas que el sitio original)
    wp_enqueue_style(
        'es-fonts',
        'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=IBM+Plex+Sans:wght@300;400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap',
        [],
        null
    );

    // CSS compilado (Tailwind) — ver assets/css/app.css
    wp_enqueue_style(
        'es-app',
        ES_THEME_URI . '/assets/css/app.css',
        [ 'es-fonts' ],
        ES_THEME_VERSION
    );

    // Lucide (iconos SVG, vía CDN — liviano, solo los íconos usados se referencian inline igual,
    // pero dejamos disponible el paquete completo por si se agregan más íconos desde el editor).
    wp_enqueue_script(
        'lucide',
        'https://cdnjs.cloudflare.com/ajax/libs/lucide-static/0.400.0/lucide.min.js',
        [],
        null,
        true
    );

    wp_enqueue_script(
        'es-main',
        ES_THEME_URI . '/assets/js/main.js',
        [],
        ES_THEME_VERSION,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'es_theme_assets' );

/** Ancho de imagen destacada, si se usa a futuro */
add_image_size( 'es-portrait', 900, 1200, true );

/**
 * Body classes: agregamos "no-js" que el JS saca al cargar, útil si en el
 * futuro se quiere degradar elegante sin animaciones cuando JS está apagado.
 */
function es_body_classes( $classes ) {
    $classes[] = 'js-pending';
    return $classes;
}
add_filter( 'body_class', 'es_body_classes' );
