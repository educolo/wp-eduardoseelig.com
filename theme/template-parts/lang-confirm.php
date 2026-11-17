<?php
/**
 * Toast de confirmación al tocar un idioma en el que la página actual no
 * existe. Lo llena y lo muestra assets/js/main.js con los data-es-confirm*
 * del link (ya en el idioma de destino). Sin JS, el link navega directo y la
 * página de destino muestra template-parts/untranslated-notice.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div id="es-lang-confirm" class="no-print fixed bottom-4 left-4 right-4 z-50 sm:left-auto sm:w-full sm:max-w-sm" hidden>
    <div class="es-fade-in border border-[hsl(var(--ink))] bg-background p-5 shadow-lg" role="alertdialog" aria-modal="false" aria-labelledby="es-lang-confirm-msg">
        <div class="flex items-start gap-3">
            <i data-lucide="languages" class="h-5 w-5 shrink-0 text-[hsl(var(--accent))]"></i>
            <p id="es-lang-confirm-msg" class="text-sm leading-relaxed"></p>
        </div>
        <div class="mt-5 flex justify-end gap-3">
            <button type="button" data-es-confirm-cancel class="inline-flex min-h-[44px] items-center px-4 font-mono-plex text-xs uppercase tracking-[0.16em] text-muted-foreground transition-colors hover:text-[hsl(var(--accent))]"></button>
            <a href="#" data-es-confirm-ok class="inline-flex min-h-[44px] items-center gap-2 bg-[hsl(var(--accent))] px-4 font-mono-plex text-xs uppercase tracking-[0.16em] text-accent-foreground transition-transform active:scale-[0.98]"></a>
        </div>
    </div>
</div>
