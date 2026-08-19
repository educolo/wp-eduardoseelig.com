<?php if ( ! defined( 'ABSPATH' ) ) exit; get_header(); ?>
<div class="min-h-screen bg-background">
    <article class="mx-auto max-w-[56rem] px-5 py-16 md:px-10">
        <?php while ( have_posts() ) : the_post(); ?>
            <h1 class="font-display text-4xl font-bold"><?php the_title(); ?></h1>
            <div class="prose mt-6 max-w-none text-muted-foreground">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    </article>
</div>
<?php get_footer(); ?>
