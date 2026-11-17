<?php
/**
 * Template Name: CV
 * Asignar esta plantilla a una página con slug "cv" (o cualquiera) desde
 * el editor de WordPress: Página > Atributos de página > Plantilla > CV.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
$perfil          = es_perfil();
$experiencia     = es_experiencia();
$educacion       = es_educacion();
$certificaciones = es_certificaciones();
$habilidades     = es_habilidades();
$enfoque         = es_enfoque();

get_header();
?>

<div class="min-h-screen bg-background">

    <div class="no-print border-b border-border bg-secondary/40">
        <div class="mx-auto flex max-w-[56rem] flex-wrap items-center justify-between gap-4 px-5 py-6 md:px-10">
            <p class="font-mono-plex text-xs uppercase tracking-[0.16em] text-muted-foreground"><?php es_ui_t( 'cv.actualizado' ); ?></p>
            <button type="button" onclick="window.print()" class="inline-flex min-h-[44px] items-center gap-2 bg-[hsl(var(--accent))] px-5 font-mono-plex text-xs uppercase tracking-[0.16em] text-accent-foreground transition-transform active:scale-[0.98]">
                <i data-lucide="download" class="h-4 w-4"></i> <?php es_ui_t( 'cv.descargar' ); ?>
            </button>
        </div>
    </div>

    <article class="mx-auto max-w-[56rem] px-5 py-14 md:px-10">
        <header class="border-b-2 border-[hsl(var(--ink))] pb-7">
            <h1 class="font-display text-4xl font-bold leading-none sm:text-5xl"><?php echo esc_html( $perfil['name'] ); ?></h1>
            <p class="mt-3 font-mono-plex text-xs uppercase tracking-[0.18em] text-muted-foreground"><?php es_t( $perfil['role'] ); ?></p>
            <div class="mt-5 flex flex-wrap gap-x-6 gap-y-2 text-sm text-muted-foreground">
                <a href="mailto:<?php echo esc_attr( $perfil['email'] ); ?>" class="flex items-center gap-2 hover:underline"><i data-lucide="mail" class="h-4 w-4"></i> <?php echo esc_html( $perfil['email'] ); ?></a>
                <span class="flex items-center gap-2"><i data-lucide="map-pin" class="h-4 w-4"></i> <?php es_t( $perfil['location'] ); ?></span>
                <a href="<?php echo esc_url( $perfil['linkedin'] ); ?>" target="_blank" rel="noreferrer" class="flex items-center gap-2 hover:underline"><i data-lucide="linkedin" class="h-4 w-4"></i> LinkedIn</a>
                <a href="<?php echo esc_url( $perfil['github'] ); ?>" target="_blank" rel="noreferrer" class="flex items-center gap-2 hover:underline"><i data-lucide="github" class="h-4 w-4"></i> GitHub</a>
                <a href="<?php echo esc_url( $perfil['website'] ); ?>" target="_blank" rel="noreferrer" class="flex items-center gap-2 hover:underline"><i data-lucide="globe" class="h-4 w-4"></i> eduardoseelig.com</a>
            </div>
        </header>

        <section class="py-8">
            <h2 class="font-mono-plex text-[11px] uppercase tracking-[0.2em] text-[hsl(var(--accent))]"><?php es_ui_t( 'cv.perfil' ); ?></h2>
            <p class="mt-3 leading-relaxed text-muted-foreground"><?php es_t( $perfil['summary'] ); ?></p>
        </section>

        <section class="border-t border-border py-8">
            <h2 class="font-mono-plex text-[11px] uppercase tracking-[0.2em] text-[hsl(var(--accent))]"><?php es_ui_t( 'cv.experiencia' ); ?></h2>
            <div class="mt-5 space-y-7">
                <?php foreach ( $experiencia as $e ) : ?>
                    <div class="grid gap-2 sm:grid-cols-[10rem_1fr]">
                        <p class="font-mono-plex text-[11px] uppercase tracking-[0.14em] text-muted-foreground"><?php es_t( $e['period'] ); ?></p>
                        <div>
                            <h3 class="font-display text-lg font-semibold"><?php es_t( $e['position'] ); ?></h3>
                            <p class="text-sm text-muted-foreground"><?php es_t( $e['company'] ); ?></p>
                            <?php
                            es_t_list( $e['details']['es'], $e['details']['en'], 'ul', 'mt-2 space-y-1 text-sm text-muted-foreground', function( $d ) {
                                echo '<li>— ' . esc_html( $d ) . '</li>';
                            } );
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="border-t border-border py-8">
            <h2 class="font-mono-plex text-[11px] uppercase tracking-[0.2em] text-[hsl(var(--accent))]"><?php es_ui_t( 'cv.formacion' ); ?></h2>
            <div class="mt-5 space-y-4">
                <?php foreach ( $certificaciones as $c ) : ?>
                    <div class="grid gap-1 sm:grid-cols-[10rem_1fr]">
                        <p class="font-mono-plex text-[11px] uppercase tracking-[0.14em] text-muted-foreground"><?php es_t( $c['period'] ); ?></p>
                        <div>
                            <h3 class="font-display text-base font-semibold"><?php echo esc_html( $c['title'] ); ?></h3>
                            <p class="flex flex-wrap items-center gap-x-1.5 gap-y-0.5 text-sm text-muted-foreground">
                                <span><?php es_t( $c['issuer'] ); ?></span>
                                <?php if ( ! empty( $c['link'] ) ) : ?>
                                    <span aria-hidden="true">·</span>
                                    <a href="<?php echo esc_url( $c['link'] ); ?>" target="_blank" rel="noreferrer" class="inline-flex items-center gap-1 hover:underline"><i data-lucide="badge-check" class="h-3.5 w-3.5 shrink-0"></i> <?php es_t( [ 'es' => 'Verificar', 'en' => 'Verify' ] ); ?></a>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php foreach ( $educacion as $e ) : ?>
                    <div class="grid gap-1 sm:grid-cols-[10rem_1fr]">
                        <p class="font-mono-plex text-[11px] uppercase tracking-[0.14em] text-muted-foreground"><?php es_t( $e['period'] ); ?></p>
                        <div>
                            <h3 class="font-display text-base font-semibold"><?php es_t( $e['title'] ); ?></h3>
                            <p class="text-sm text-muted-foreground"><?php es_t( $e['place'] ); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="border-t border-border py-8">
            <h2 class="font-mono-plex text-[11px] uppercase tracking-[0.2em] text-[hsl(var(--accent))]"><?php es_ui_t( 'cv.enfoque' ); ?></h2>
            <div class="mt-5 space-y-4">
                <?php foreach ( $enfoque as $s ) : ?>
                    <div>
                        <h3 class="font-display text-base font-semibold"><?php es_t( $s['title'] ); ?></h3>
                        <p class="text-sm text-muted-foreground"><?php es_t( $s['promise'] ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="border-t border-border py-8">
            <h2 class="font-mono-plex text-[11px] uppercase tracking-[0.2em] text-[hsl(var(--accent))]"><?php es_ui_t( 'cv.stack' ); ?></h2>
            <ul class="mt-4 flex flex-wrap gap-2">
                <?php foreach ( $habilidades as $h ) : ?>
                    <li class="border border-border px-2.5 py-1 font-mono-plex text-[11px] uppercase tracking-[0.12em] text-muted-foreground"><?php echo esc_html( $h ); ?></li>
                <?php endforeach; ?>
            </ul>
        </section>
    </article>

</div>

<?php get_footer(); ?>
