<?php
/**
 * index.php — fallback requerido por WordPress.
 * El sitio usa front-page.php (home), page-cv.php y page-cursos.php como
 * plantillas específicas. Este archivo solo cubre el caso genérico
 * (por ejemplo, el listado del blog si en el futuro se activa).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>
<div class="min-h-screen bg-background">
    <div class="mx-auto max-w-[80rem] px-5 py-16 md:px-10">
        <?php if ( have_posts() ) : ?>
            <div class="space-y-10">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="border-b border-border pb-10">
                        <h2 class="font-display text-2xl font-bold"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="mt-3 text-muted-foreground"><?php the_excerpt(); ?></div>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p class="text-muted-foreground"><?php esc_html_e( 'No hay contenido.', 'eduardo-seelig' ); ?></p>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
