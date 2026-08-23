<?php
/**
 * single.php — entrada individual del blog (bilingüe ES/EN con fallback).
 * La versión en español es el contenido nativo del post; la versión en
 * inglés viene del meta box "Versión en inglés (EN)" (ver inc/blog.php).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

while ( have_posts() ) : the_post();
    $t = es_post_titles();
    $c = es_post_contents();
    ?>
    <div class="min-h-screen bg-background">
        <article class="mx-auto max-w-3xl px-5 py-16 md:px-10 md:py-20">
            <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="inline-flex items-center gap-2 font-mono-plex text-xs uppercase tracking-[0.16em] text-muted-foreground transition-colors hover:text-[hsl(var(--accent))]">
                <i data-lucide="arrow-left" class="h-4 w-4"></i> <?php es_ui_t( 'blogPage.volver' ); ?>
            </a>

            <p class="mt-8 font-mono-plex text-[11px] uppercase tracking-[0.16em] text-muted-foreground"><?php echo esc_html( get_the_date() ); ?></p>
            <h1 class="mt-3 font-display text-4xl font-bold leading-[1.05] sm:text-5xl"><?php es_t( $t ); ?></h1>

            <div class="blog-content mt-10">
                <?php es_print_bilingual_html( $c['es'], $c['en'] ); ?>
            </div>
        </article>
    </div>
    <?php
endwhile;

get_footer();
