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
require_once ES_THEME_DIR . '/inc/blog.php';

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

    // Lucide (iconos SVG). IMPORTANTE: usar el build de runtime (paquete "lucide"),
    // que expone window.lucide.createIcons(). El paquete "lucide-static" NO lo expone,
    // por lo que los <i data-lucide="..."> no se reemplazaban y los íconos no se veían.
    wp_enqueue_script(
        'lucide',
        'https://cdn.jsdelivr.net/npm/lucide@0.400.0/dist/umd/lucide.min.js',
        [],
        null,
        true
    );

    wp_enqueue_script(
        'es-main',
        ES_THEME_URI . '/assets/js/main.js',
        [ 'lucide' ],
        ES_THEME_VERSION,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'es_theme_assets' );

/** Ancho de imagen destacada, si se usa a futuro */
add_image_size( 'es-portrait', 900, 1200, true );

/**
 * Favicon / iconos del sitio (monograma "ES", generado en assets/favicon).
 * Se imprime en <head> salvo que ya haya un Site Icon configurado desde el
 * Customizer (en ese caso mandan los del Customizer y no duplicamos).
 */
function es_favicon_tags() {
    if ( function_exists( 'has_site_icon' ) && has_site_icon() ) {
        return;
    }
    $base = ES_THEME_URI . '/assets/favicon';
    printf( '<link rel="icon" href="%s/favicon.ico" sizes="any">' . "\n", esc_url( $base ) );
    printf( '<link rel="icon" type="image/svg+xml" href="%s/favicon.svg">' . "\n", esc_url( $base ) );
    printf( '<link rel="icon" type="image/png" sizes="32x32" href="%s/favicon-32x32.png">' . "\n", esc_url( $base ) );
    printf( '<link rel="icon" type="image/png" sizes="16x16" href="%s/favicon-16x16.png">' . "\n", esc_url( $base ) );
    printf( '<link rel="apple-touch-icon" sizes="180x180" href="%s/apple-touch-icon.png">' . "\n", esc_url( $base ) );
    printf( '<link rel="manifest" href="%s/site.webmanifest">' . "\n", esc_url( $base ) );
    echo '<meta name="theme-color" content="#f9f8f6">' . "\n";
}
add_action( 'wp_head', 'es_favicon_tags', 5 );

/**
 * Body classes: agregamos "no-js" que el JS saca al cargar, útil si en el
 * futuro se quiere degradar elegante sin animaciones cuando JS está apagado.
 */
function es_body_classes( $classes ) {
    $classes[] = 'js-pending';
    return $classes;
}
add_filter( 'body_class', 'es_body_classes' );
