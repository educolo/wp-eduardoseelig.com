<?php
/**
 * Template Name: Cursos
 * Asignar esta plantilla a una página con slug "cursos" desde el editor de
 * WordPress: Página > Atributos de página > Plantilla > Cursos.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
$perfil = es_perfil();
$cursos = es_cursos();

// Formatos únicos (es), para armar los botones de filtro.
$formatos_es = [];
foreach ( $cursos as $c ) { $formatos_es[ $c['formato']['es'] ] = $c['formato']['en']; }

get_header();
?>

<div class="min-h-screen bg-background">

    <section class="border-b border-border">
        <div class="mx-auto max-w-[80rem] px-5 py-16 md:px-10 md:py-20">
            <p class="font-mono-plex text-xs uppercase tracking-[0.24em] text-[hsl(var(--accent))]"><?php es_ui_t( 'cursosPage.tag' ); ?></p>
            <h1 class="mt-5 max-w-3xl font-display text-4xl font-bold leading-[1.02] sm:text-6xl"><?php es_ui_t( 'cursosPage.titulo' ); ?></h1>
            <p class="mt-6 max-w-xl text-lg text-muted-foreground"><?php es_ui_t( 'cursosPage.sub' ); ?></p>

            <div class="mt-10 flex flex-wrap gap-2" id="es-cursos-filtros">
                <button type="button" class="es-filtro-btn min-h-[44px] border px-5 font-mono-plex text-xs uppercase tracking-[0.14em] transition-colors active:scale-[0.98]" data-filtro="all">
                    <?php es_ui_t( 'cursosPage.todos' ); ?>
                </button>
                <?php foreach ( $formatos_es as $es => $en ) : ?>
                    <button type="button" class="es-filtro-btn min-h-[44px] border px-5 font-mono-plex text-xs uppercase tracking-[0.14em] transition-colors active:scale-[0.98]" data-filtro-es="<?php echo esc_attr( $es ); ?>">
                        <?php es_t( [ 'es' => $es, 'en' => $en ] ); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="bg-secondary/40">
        <div class="mx-auto max-w-[80rem] px-5 py-16 md:px-10">
            <div class="grid gap-px border border-border bg-border md:grid-cols-2" id="es-cursos-grid">
                <?php foreach ( $cursos as $c ) : ?>
                    <article class="es-curso-card flex h-full flex-col bg-background p-8" data-formato-es="<?php echo esc_attr( $c['formato']['es'] ); ?>">
                        <div class="flex items-center justify-between gap-4">
                            <p class="font-mono-plex text-[11px] uppercase tracking-[0.16em] text-muted-foreground">
                                <?php es_t( $c['formato'] ); ?> · <?php es_t( $c['nivel'] ); ?>
                            </p>
                        </div>
                        <h2 class="mt-4 font-display text-2xl font-semibold leading-snug"><?php es_t( $c['titulo'] ); ?></h2>
                        <p class="mt-3 text-sm leading-relaxed text-muted-foreground"><?php es_t( $c['descripcion'] ); ?></p>
                        <?php
                        es_t_list( $c['temas']['es'], $c['temas']['en'], 'ul', 'mt-5 flex flex-wrap gap-2', function( $tm ) {
                            echo '<li class="border border-border px-2.5 py-1 font-mono-plex text-[11px] uppercase tracking-[0.12em] text-muted-foreground">' . esc_html( $tm ) . '</li>';
                        } );
                        ?>
                        <a href="<?php echo esc_url( $perfil['website'] ); ?>" target="_blank" rel="noreferrer" class="mt-auto inline-flex items-center gap-2 pt-7 font-mono-plex text-xs uppercase tracking-[0.16em] underline decoration-[hsl(var(--accent))] decoration-2 underline-offset-4">
                            <?php es_ui_t( 'cursosPage.leer' ); ?> <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
            <p class="hidden py-16 text-center font-display text-xl text-muted-foreground" id="es-cursos-vacio"><?php es_ui_t( 'cursosPage.vacio' ); ?></p>
        </div>
    </section>

</div>

<?php get_footer(); ?>
