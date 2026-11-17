<?php
/**
 * Aviso que se muestra cuando el visitante cambió de idioma desde una página
 * sin traducción (llega con ?untranslated=1, ver es_lang_links()).
 * $args['message']: ruta del texto en ui-strings.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! es_is_untranslated_redirect() ) return;
?>
<div class="border-b border-border bg-secondary" role="status">
    <div class="mx-auto flex max-w-[90rem] items-center gap-3 px-5 py-4 text-sm leading-relaxed md:px-10">
        <i data-lucide="info" class="h-4 w-4 shrink-0 text-[hsl(var(--accent))]"></i>
        <p><?php echo esc_html( es_ui_get( $args['message'] ?? 'notices.untranslatedPage' ) ); ?></p>
    </div>
</div>
