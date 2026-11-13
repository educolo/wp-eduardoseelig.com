<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<nav class="inline-flex items-center border border-border" aria-label="Idioma / Language">
    <?php foreach ( es_lang_links() as $l ) : ?>
        <a href="<?php echo esc_url( $l['url'] ); ?>"
           hreflang="<?php echo esc_attr( $l['slug'] ); ?>"
           lang="<?php echo esc_attr( $l['slug'] ); ?>"
           <?php if ( $l['current'] ) : ?>aria-current="true"<?php endif; ?>
           class="px-2.5 py-2 font-mono-plex text-[11px] uppercase tracking-[0.14em] transition-colors <?php echo $l['current'] ? 'bg-[hsl(var(--ink))] text-primary-foreground' : 'text-muted-foreground hover:text-[hsl(var(--accent))]'; ?>"><?php echo esc_html( $l['slug'] ); ?></a>
    <?php endforeach; ?>
</nav>
