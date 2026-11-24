<?php
/**
 * Banner de consentimiento de cookies de analítica (ver inc/analytics.php).
 * Sale oculto: assets/js/main.js lo muestra a visitantes con zona horaria
 * europea que todavía no eligieron, o a cualquiera que toque "Cookies" en el
 * footer. Sin JS no aparece, y tampoco hace falta: sin decisión guardada, en
 * la UE el consentimiento queda denegado por defecto.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
$privacy_url = es_privacy_url();
?>
<div id="es-cookie-banner" class="no-print fixed bottom-4 left-4 right-4 z-50 sm:right-auto sm:w-full sm:max-w-sm" data-es-consent-key="<?php echo esc_attr( ES_CONSENT_KEY ); ?>" hidden>
    <div class="es-fade-in border border-[hsl(var(--ink))] bg-background p-5 shadow-lg" role="dialog" aria-modal="false" aria-labelledby="es-cookie-banner-msg">
        <div class="flex items-start gap-3">
            <i data-lucide="cookie" class="h-5 w-5 shrink-0 text-[hsl(var(--accent))]"></i>
            <p id="es-cookie-banner-msg" class="text-sm leading-relaxed">
                <?php echo esc_html( es_ui_get( 'cookies.message' ) ); ?>
                <?php if ( $privacy_url ) : ?>
                    <a href="<?php echo esc_url( $privacy_url ); ?>" class="underline underline-offset-2 hover:text-[hsl(var(--accent))]"><?php echo esc_html( es_ui_get( 'cookies.privacy' ) ); ?></a>
                <?php endif; ?>
            </p>
        </div>
        <div class="mt-5 flex justify-end gap-3">
            <button type="button" data-es-consent="denied" class="inline-flex min-h-[44px] items-center border border-[hsl(var(--ink))] px-4 font-mono-plex text-xs uppercase tracking-[0.16em] transition-colors hover:bg-secondary"><?php echo esc_html( es_ui_get( 'cookies.reject' ) ); ?></button>
            <button type="button" data-es-consent="granted" class="inline-flex min-h-[44px] items-center gap-2 bg-[hsl(var(--accent))] px-4 font-mono-plex text-xs uppercase tracking-[0.16em] text-accent-foreground transition-transform active:scale-[0.98]"><?php echo esc_html( es_ui_get( 'cookies.accept' ) ); ?></button>
        </div>
    </div>
</div>
