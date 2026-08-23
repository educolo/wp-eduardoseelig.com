<?php if ( ! defined( 'ABSPATH' ) ) exit; $perfil = es_perfil(); ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="no-print sticky top-0 z-40 border-b border-border/70 bg-background/85 backdrop-blur">
    <div class="mx-auto flex max-w-[90rem] items-center justify-between gap-6 px-5 py-4 md:px-10">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="group flex items-center gap-3">
            <span class="grid h-9 w-9 place-items-center bg-[hsl(var(--ink))] font-display text-sm font-bold text-primary-foreground">
                <?php echo esc_html( $perfil['iniciales'] ); ?>
            </span>
            <span class="font-display text-sm font-semibold uppercase tracking-[0.18em]">
                <?php echo esc_html( $perfil['nombre'] ); ?>
            </span>
        </a>

        <nav class="hidden items-center gap-7 md:flex">
            <a href="<?php echo esc_url( home_url( '/#enfoque' ) ); ?>" class="font-mono-plex text-xs uppercase tracking-[0.16em] text-muted-foreground transition-colors hover:text-[hsl(var(--accent))]"><?php es_ui_t( 'nav.enfoque' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/#trabajo' ) ); ?>" class="font-mono-plex text-xs uppercase tracking-[0.16em] text-muted-foreground transition-colors hover:text-[hsl(var(--accent))]"><?php es_ui_t( 'nav.trabajo' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="font-mono-plex text-xs uppercase tracking-[0.16em] text-muted-foreground transition-colors hover:text-[hsl(var(--accent))]"><?php es_ui_t( 'nav.blog' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/cv' ) ); ?>" class="font-mono-plex text-xs uppercase tracking-[0.16em] text-muted-foreground transition-colors hover:text-[hsl(var(--accent))]"><?php es_ui_t( 'nav.cv' ); ?></a>
            <a href="<?php echo esc_url( $perfil['github'] ); ?>" target="_blank" rel="noreferrer" aria-label="GitHub" class="text-muted-foreground transition-colors hover:text-[hsl(var(--accent))]">
                <i data-lucide="github" class="h-4 w-4"></i>
            </a>
            <a href="<?php echo esc_url( $perfil['linkedin'] ); ?>" target="_blank" rel="noreferrer" aria-label="LinkedIn" class="text-muted-foreground transition-colors hover:text-[hsl(var(--accent))]">
                <i data-lucide="linkedin" class="h-4 w-4"></i>
            </a>
            <?php get_template_part( 'template-parts/lang-toggle' ); ?>
        </nav>

        <div class="flex items-center gap-3 md:hidden">
            <?php get_template_part( 'template-parts/lang-toggle' ); ?>
            <button type="button" aria-label="Abrir menú" id="es-menu-btn" class="grid h-11 w-11 place-items-center border border-border">
                <i data-lucide="menu" class="h-5 w-5" id="es-menu-icon-open"></i>
                <i data-lucide="x" class="hidden h-5 w-5" id="es-menu-icon-close"></i>
            </button>
        </div>
    </div>

    <div id="es-mobile-menu" class="hidden border-t border-border bg-background px-5 pb-6 pt-2 md:hidden">
        <a href="<?php echo esc_url( home_url( '/#enfoque' ) ); ?>" class="block border-b border-border/60 py-4 font-display text-lg"><?php es_ui_t( 'nav.enfoque' ); ?></a>
        <a href="<?php echo esc_url( home_url( '/#trabajo' ) ); ?>" class="block border-b border-border/60 py-4 font-display text-lg"><?php es_ui_t( 'nav.trabajo' ); ?></a>
        <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="block border-b border-border/60 py-4 font-display text-lg"><?php es_ui_t( 'nav.blog' ); ?></a>
        <a href="<?php echo esc_url( home_url( '/cv' ) ); ?>" class="block border-b border-border/60 py-4 font-display text-lg"><?php es_ui_t( 'nav.cv' ); ?></a>
        <div class="mt-5 flex gap-6">
            <a href="<?php echo esc_url( $perfil['github'] ); ?>" target="_blank" rel="noreferrer" class="inline-flex items-center gap-2 font-mono-plex text-xs uppercase tracking-[0.16em] text-muted-foreground">
                <i data-lucide="github" class="h-4 w-4"></i> GitHub
            </a>
            <a href="<?php echo esc_url( $perfil['linkedin'] ); ?>" target="_blank" rel="noreferrer" class="inline-flex items-center gap-2 font-mono-plex text-xs uppercase tracking-[0.16em] text-muted-foreground">
                <i data-lucide="linkedin" class="h-4 w-4"></i> LinkedIn
            </a>
        </div>
    </div>
</header>
