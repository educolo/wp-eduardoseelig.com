<?php
/**
 * Google Analytics 4 con Consent Mode v2, sin plugins.
 *
 * En <head>, antes que cualquier otro script, se imprime:
 *   1. El estado de consentimiento por defecto: denegado en la UE/EEE, Reino
 *      Unido y Suiza (lo resuelve Google según el país del visitante) y
 *      concedido en el resto del mundo.
 *   2. La decisión que el visitante ya haya tomado en el banner (localStorage).
 *   3. La carga de gtag.js con el ID de GA4.
 *
 * El banner (template-parts/cookie-banner.php) y su lógica (assets/js/main.js)
 * guardan la decisión y la comunican con gtag('consent', 'update', ...).
 *
 * Mientras Site Kit siga activo, el tema solo imprime el consentimiento (que
 * aplica también a la etiqueta de Site Kit) y no carga gtag.js, para no medir
 * dos veces. Al desinstalar Site Kit, el tema pasa a cargar GA solo.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'ES_GA_ID', 'G-YMDVYXVKJ2' );

/** Dominio donde se mide. En local/staging no se carga GA. */
define( 'ES_GA_HOST', 'eduardoseelig.com' );

/** Clave de localStorage donde se guarda la decisión ('granted' | 'denied'). */
define( 'ES_CONSENT_KEY', 'es_consent' );

/** Países donde el consentimiento arranca denegado: UE + EEE (IS, LI, NO) + GB + CH. */
define( 'ES_CONSENT_REGIONS', [
    'AT', 'BE', 'BG', 'HR', 'CY', 'CZ', 'DK', 'EE', 'FI', 'FR', 'DE', 'GR', 'HU', 'IE',
    'IT', 'LV', 'LT', 'LU', 'MT', 'NL', 'PL', 'PT', 'RO', 'SK', 'SI', 'ES', 'SE',
    'IS', 'LI', 'NO', 'GB', 'CH',
] );

/** ¿Hay que cargar gtag.js desde el tema? */
function es_analytics_should_load() {
    $is_prod_host = wp_parse_url( home_url(), PHP_URL_HOST ) === ES_GA_HOST;
    $site_kit_on  = defined( 'GOOGLESITEKIT_VERSION' );
    $load         = $is_prod_host && ! $site_kit_on && ! is_user_logged_in();
    /** Permite forzar o desactivar la carga (por ejemplo, para probar en local). */
    return (bool) apply_filters( 'es_analytics_should_load', $load );
}

/** Consent Mode + gtag.js. Prioridad 0: tiene que ir antes que cualquier etiqueta de Google. */
function es_analytics_head() {
    $denied = [
        'analytics_storage'  => 'denied',
        'ad_storage'         => 'denied',
        'ad_user_data'       => 'denied',
        'ad_personalization' => 'denied',
        'region'             => ES_CONSENT_REGIONS,
        'wait_for_update'    => 500,
    ];
    $granted = [
        'analytics_storage'  => 'granted',
        // No se usa publicidad: las señales de anuncios quedan siempre denegadas.
        'ad_storage'         => 'denied',
        'ad_user_data'       => 'denied',
        'ad_personalization' => 'denied',
    ];
    ?>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('consent', 'default', <?php echo wp_json_encode( $denied ); ?>);
gtag('consent', 'default', <?php echo wp_json_encode( $granted ); ?>);
try {
    var esConsent = localStorage.getItem(<?php echo wp_json_encode( ES_CONSENT_KEY ); ?>);
    if (esConsent === 'granted' || esConsent === 'denied') {
        gtag('consent', 'update', { analytics_storage: esConsent });
    }
} catch (e) {}
</script>
    <?php
    if ( ! es_analytics_should_load() ) {
        return;
    }
    ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( ES_GA_ID ); ?>"></script>
<script>
gtag('js', new Date());
gtag('config', <?php echo wp_json_encode( ES_GA_ID ); ?>);
</script>
    <?php
}
add_action( 'wp_head', 'es_analytics_head', 0 );

/**
 * URL de la política de privacidad en el idioma actual: la página elegida en
 * Ajustes → Privacidad, o su traducción de Polylang. Cadena vacía si no hay
 * una página publicada.
 */
function es_privacy_url() {
    $id = (int) get_option( 'wp_page_for_privacy_policy' );
    if ( ! $id ) {
        return '';
    }
    if ( function_exists( 'pll_get_post' ) ) {
        $id = pll_get_post( $id, es_lang() ) ?: $id;
    }
    return 'publish' === get_post_status( $id ) ? get_permalink( $id ) : '';
}
