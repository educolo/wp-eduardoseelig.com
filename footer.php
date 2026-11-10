<?php if ( ! defined( 'ABSPATH' ) ) exit; $perfil = es_perfil(); ?>
<footer class="no-print border-t border-border bg-[hsl(var(--ink))] text-[hsl(40_20%_92%)]">
    <div class="mx-auto grid max-w-[90rem] gap-10 px-5 py-14 md:grid-cols-[1.4fr_1fr_1fr_1fr] md:px-10">
        <div>
            <p class="font-display text-2xl font-semibold"><?php echo esc_html( $perfil['nombre'] ); ?></p>
            <p class="mt-2 max-w-sm text-sm text-[hsl(40_10%_70%)]"><?php es_t( $perfil['rol'] ); ?></p>
        </div>
        <div class="space-y-3 text-sm">
            <p class="font-mono-plex text-xs uppercase tracking-[0.18em] text-[hsl(var(--accent))]"><?php es_ui_t( 'footer.contacto' ); ?></p>
            <a href="mailto:<?php echo esc_attr( $perfil['email'] ); ?>" class="flex items-center gap-2 hover:underline">
                <i data-lucide="mail" class="h-4 w-4"></i> <?php echo esc_html( $perfil['email'] ); ?>
            </a>
            <p class="flex items-center gap-2 text-[hsl(40_10%_70%)]">
                <i data-lucide="map-pin" class="h-4 w-4"></i> <?php es_t( $perfil['ubicacion'] ); ?>
            </p>
        </div>
        <div class="space-y-3 text-sm">
            <p class="font-mono-plex text-xs uppercase tracking-[0.18em] text-[hsl(var(--accent))]"><?php es_ui_t( 'footer.redes' ); ?></p>
            <a href="<?php echo esc_url( $perfil['linkedin'] ); ?>" target="_blank" rel="noreferrer" class="flex items-center gap-2 hover:underline">
                <i data-lucide="linkedin" class="h-4 w-4"></i> LinkedIn
            </a>
            <a href="<?php echo esc_url( $perfil['github'] ); ?>" target="_blank" rel="noreferrer" class="flex items-center gap-2 hover:underline">
                <i data-lucide="github" class="h-4 w-4"></i> GitHub
            </a>
            <a href="<?php echo esc_url( $perfil['website'] ); ?>" target="_blank" rel="noreferrer" class="flex items-center gap-2 hover:underline">
                <i data-lucide="globe" class="h-4 w-4"></i> eduardoseelig.com
            </a>
        </div>
        <div class="space-y-3 text-sm">
            <p class="font-mono-plex text-xs uppercase tracking-[0.18em] text-[hsl(var(--accent))]"><?php es_ui_t( 'footer.secciones' ); ?></p>
            <a href="<?php echo esc_url( home_url( '/#enfoque' ) ); ?>" class="block hover:underline"><?php es_ui_t( 'nav.enfoque' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/#trabajo' ) ); ?>" class="block hover:underline"><?php es_ui_t( 'nav.trabajo' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="block hover:underline"><?php es_ui_t( 'nav.blog' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/cv' ) ); ?>" class="block hover:underline"><?php es_ui_t( 'nav.cv' ); ?></a>
        </div>
    </div>
    <div class="border-t border-white/10 px-5 py-6 text-center font-mono-plex text-[11px] uppercase tracking-[0.18em] text-[hsl(40_8%_55%)] md:px-10">
        © <?php echo esc_html( date( 'Y' ) ); ?> <?php echo esc_html( $perfil['nombre'] ); ?> · Argentina
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
