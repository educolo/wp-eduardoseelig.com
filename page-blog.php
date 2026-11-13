<?php
/**
 * Template Name: Blog
 * Asignar esta plantilla a una página con slug "blog" desde el editor de
 * WordPress: Página > Atributos de página > Plantilla > Blog.
 *
 * Lista las entradas (posts) del blog en el idioma actual (Polylang filtra
 * la consulta). La página en inglés es la traducción de esta, con la misma
 * plantilla.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

$es_blog_q = new WP_Query( [
    'post_type'           => 'post',
    'posts_per_page'      => 24,
    'ignore_sticky_posts' => true,
] );
?>

<div class="min-h-screen bg-background">

    <section class="border-b border-border">
        <div class="mx-auto max-w-[80rem] px-5 py-16 md:px-10 md:py-20">
            <p class="font-mono-plex text-xs uppercase tracking-[0.24em] text-[hsl(var(--accent))]"><?php es_ui_t( 'blogPage.tag' ); ?></p>
            <h1 class="mt-5 max-w-3xl font-display text-4xl font-bold leading-[1.02] sm:text-6xl"><?php es_ui_t( 'blogPage.titulo' ); ?></h1>
            <p class="mt-6 max-w-xl text-lg text-muted-foreground"><?php es_ui_t( 'blogPage.sub' ); ?></p>
        </div>
    </section>

    <section class="bg-secondary/40">
        <div class="mx-auto max-w-[80rem] px-5 py-16 md:px-10">
            <?php if ( $es_blog_q->have_posts() ) : ?>
                <div class="grid gap-px border border-border bg-border md:grid-cols-2">
                    <?php while ( $es_blog_q->have_posts() ) : $es_blog_q->the_post(); ?>
                        <article class="flex h-full flex-col bg-background p-8">
                            <p class="font-mono-plex text-[11px] uppercase tracking-[0.16em] text-muted-foreground"><?php echo esc_html( get_the_date() ); ?></p>
                            <h2 class="mt-4 font-display text-2xl font-semibold leading-snug"><a href="<?php the_permalink(); ?>" class="hover:text-[hsl(var(--accent))]"><?php the_title(); ?></a></h2>
                            <p class="mt-3 text-sm leading-relaxed text-muted-foreground"><?php echo esc_html( get_the_excerpt() ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="mt-auto inline-flex items-center gap-2 pt-7 font-mono-plex text-xs uppercase tracking-[0.16em] underline decoration-[hsl(var(--accent))] decoration-2 underline-offset-4">
                                <?php es_ui_t( 'blogPage.leer' ); ?> <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                            </a>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            <?php else : ?>
                <p class="py-16 text-center font-display text-xl text-muted-foreground"><?php es_ui_t( 'blogPage.vacio' ); ?></p>
            <?php endif; ?>
        </div>
    </section>

</div>

<?php get_footer(); ?>
