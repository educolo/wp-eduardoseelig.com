<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="inline-flex items-center border border-border" role="group" aria-label="Idioma / Language">
    <?php foreach ( es_lang_links() as $l ) : ?>
        <a href="<?php echo esc_url( $l['url'] ); ?>"
           hreflang="<?php echo esc_attr( $l['slug'] ); ?>"
           lang="<?php echo esc_attr( $l['slug'] ); ?>"
           aria-label="<?php echo esc_attr( $l['name'] ); ?>"
           <?php if ( $l['current'] ) : ?>aria-current="page"<?php endif; ?>
           class="px-2.5 py-2 font-mono-plex text-[11px] uppercase tracking-[0.14em] transition-colors <?php echo $l['current'] ? 'bg-[hsl(var(--ink))] text-primary-foreground' : 'text-muted-foreground hover:text-[hsl(var(--accent))]'; ?>"><?php echo esc_html( $l['slug'] ); ?></a>
    <?php endforeach; ?>
</div>
