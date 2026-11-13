<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$perfil     = es_perfil();
$enfoque    = es_enfoque();
$proyectos  = es_proyectos();
$experiencia = es_experiencia();
$habilidades = es_habilidades();
$icon_map   = [ 'producto' => 'layers', 'ingenieria' => 'code-2', 'ia' => 'sparkles' ];
$ticker_items = es_habilidades_ticker();

get_header();
?>

<div class="min-h-screen bg-background">

    <!-- HERO -->
    <section class="relative overflow-hidden border-b border-border">
        <div class="pointer-events-none absolute inset-0 grid-lines opacity-60"></div>
        <div class="relative mx-auto grid max-w-[90rem] gap-12 px-5 py-16 md:grid-cols-[1.15fr_0.85fr] md:items-end md:px-10 md:py-24">
            <div>
                <p class="font-mono-plex text-xs uppercase tracking-[0.24em] text-[hsl(var(--accent))] es-fade-in">
                    <?php es_t( [ 'es' => es_ui_get('hero.tag','es'), 'en' => es_ui_get('hero.tag','en') ] ); ?>
                </p>
                <h1 class="mt-6 font-display text-[2.6rem] font-bold leading-[0.98] tracking-tight sm:text-6xl lg:text-[4.4rem]">
                    <span class="block es-fade-in" style="--d:0.06s"><?php es_t( [ 'es' => es_ui_get('hero.linea1','es'), 'en' => es_ui_get('hero.linea1','en') ] ); ?></span>
                    <span class="block es-fade-in" style="--d:0.12s"><?php es_t( [ 'es' => es_ui_get('hero.linea2','es'), 'en' => es_ui_get('hero.linea2','en') ] ); ?></span>
                    <span class="marker-underline inline-block es-fade-in" style="--d:0.18s"><?php es_t( [ 'es' => es_ui_get('hero.linea3','es'), 'en' => es_ui_get('hero.linea3','en') ] ); ?></span>
                </h1>
                <p class="mt-7 max-w-xl text-lg leading-relaxed text-muted-foreground">
                    <?php es_t( $perfil['summary'] ); ?>
                </p>
                <div class="mt-9 flex flex-wrap gap-3">
                    <a href="#<?php echo esc_attr( es_anchor( 'contacto' ) ); ?>" class="inline-flex min-h-[48px] items-center gap-2 bg-[hsl(var(--accent))] px-6 font-mono-plex text-xs uppercase tracking-[0.16em] text-accent-foreground transition-transform active:scale-[0.98]">
                        <?php es_ui_t( 'hero.ctaContacto' ); ?> <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                    </a>
                    <a href="#<?php echo esc_attr( es_anchor( 'trabajo' ) ); ?>" class="inline-flex min-h-[48px] items-center gap-2 border border-[hsl(var(--ink))] px-6 font-mono-plex text-xs uppercase tracking-[0.16em] transition-colors hover:bg-secondary">
                        <?php es_ui_t( 'hero.ctaTrabajo' ); ?>
                    </a>
                    <a href="<?php echo esc_url( es_page_url( 'cv' ) ); ?>" class="inline-flex min-h-[48px] items-center gap-2 px-2 font-mono-plex text-xs uppercase tracking-[0.16em] text-muted-foreground underline decoration-[hsl(var(--accent))] decoration-2 underline-offset-4">
                        <i data-lucide="download" class="h-4 w-4"></i> <?php es_ui_t( 'hero.cvLink' ); ?>
                    </a>
                </div>
                <div class="mt-8 flex items-center gap-5">
                    <a href="<?php echo esc_url( $perfil['linkedin'] ); ?>" target="_blank" rel="noreferrer" aria-label="LinkedIn" class="text-muted-foreground transition-colors hover:text-[hsl(var(--accent))]"><i data-lucide="linkedin" class="h-5 w-5"></i></a>
                    <a href="<?php echo esc_url( $perfil['github'] ); ?>" target="_blank" rel="noreferrer" aria-label="GitHub" class="text-muted-foreground transition-colors hover:text-[hsl(var(--accent))]"><i data-lucide="github" class="h-5 w-5"></i></a>
                </div>
            </div>

            <div class="relative es-fade-in-scale">
                <div class="absolute -bottom-4 -right-4 h-full w-full border-2 border-[hsl(var(--accent))]"></div>
                <img src="<?php echo esc_url( $perfil['photo'] ); ?>" alt="<?php echo esc_attr( $perfil['name'] ); ?>" class="relative aspect-[3/4] w-full object-cover bg-secondary" loading="eager">
            </div>
        </div>

        <!-- métricas -->
        <div class="relative border-t border-border bg-secondary/50">
            <div class="mx-auto grid max-w-[90rem] grid-cols-2 divide-x divide-border md:grid-cols-4">
                <div class="px-5 py-7 md:px-10">
                    <p class="font-display text-3xl font-bold md:text-4xl"><span class="es-countup" data-value="20">0</span>+</p>
                    <p class="mt-1 font-mono-plex text-[11px] uppercase tracking-[0.14em] text-muted-foreground"><?php es_ui_t( 'metricas.anios' ); ?></p>
                </div>
                <div class="px-5 py-7 md:px-10">
                    <p class="font-display text-3xl font-bold md:text-4xl"><span class="es-countup" data-value="30">0</span>+</p>
                    <p class="mt-1 font-mono-plex text-[11px] uppercase tracking-[0.14em] text-muted-foreground"><?php es_ui_t( 'metricas.proyectos' ); ?></p>
                </div>
                <div class="px-5 py-7 md:px-10">
                    <p class="font-display text-3xl font-bold md:text-4xl"><span class="es-countup" data-value="2">0</span></p>
                    <p class="mt-1 font-mono-plex text-[11px] uppercase tracking-[0.14em] text-muted-foreground"><?php es_ui_t( 'metricas.roles' ); ?></p>
                </div>
                <div class="px-5 py-7 md:px-10">
                    <p class="font-display text-3xl font-bold md:text-4xl"><span class="es-countup" data-value="4">0</span>+</p>
                    <p class="mt-1 font-mono-plex text-[11px] uppercase tracking-[0.14em] text-muted-foreground"><?php es_ui_t( 'metricas.paises' ); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- TICKER -->
    <div class="no-print overflow-hidden border-b border-border bg-[hsl(var(--ink))] py-4">
        <div class="ticker-track flex w-max gap-10 whitespace-nowrap">
            <?php foreach ( array_merge( $ticker_items, $ticker_items ) as $i => $tk ) : ?>
                <span class="font-mono-plex text-xs uppercase tracking-[0.28em] text-[hsl(40_12%_72%)]"><?php echo esc_html( $tk ); ?> <span class="text-[hsl(var(--accent))]">/</span></span>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ENFOQUE -->
    <section id="<?php echo esc_attr( es_anchor( 'enfoque' ) ); ?>" class="scroll-mt-24 border-b border-border">
        <div class="mx-auto max-w-[80rem] px-5 py-20 md:px-10">
            <div class="es-reveal">
                <p class="font-mono-plex text-xs uppercase tracking-[0.24em] text-[hsl(var(--accent))]"><?php es_ui_t( 'secciones.enfoque' ); ?></p>
                <h2 class="mt-4 max-w-2xl font-display text-3xl font-bold leading-tight sm:text-5xl"><?php es_ui_t( 'secciones.enfoqueTitulo' ); ?></h2>
            </div>

            <div class="mt-12 divide-y divide-border border-y border-border">
                <?php foreach ( $enfoque as $i => $s ) : ?>
                    <div class="es-reveal" style="--d: <?php echo esc_attr( $i * 0.06 ); ?>s">
                        <div class="group grid gap-6 py-10 md:grid-cols-[auto_1fr_1fr] md:gap-10">
                            <div class="flex items-start gap-4 md:w-56">
                                <span class="grid h-11 w-11 shrink-0 place-items-center border border-[hsl(var(--ink))] transition-colors group-hover:bg-[hsl(var(--accent))] group-hover:text-accent-foreground">
                                    <i data-lucide="<?php echo esc_attr( $icon_map[ $s['id'] ] ); ?>" class="h-5 w-5"></i>
                                </span>
                                <h3 class="font-display text-xl font-semibold"><?php es_t( $s['title'] ); ?></h3>
                            </div>
                            <p class="max-w-md text-base leading-relaxed text-muted-foreground md:text-lg"><?php es_t( $s['promise'] ); ?></p>
                            <?php
                            es_t_list( $s['deliverables']['es'], $s['deliverables']['en'], 'ul', 'space-y-2 text-sm text-muted-foreground', function( $e ) {
                                echo '<li class="flex gap-2"><span class="mt-2 h-1 w-3 shrink-0 bg-[hsl(var(--accent))]"></span>' . esc_html( $e ) . '</li>';
                            } );
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- TRABAJO -->
    <section id="<?php echo esc_attr( es_anchor( 'trabajo' ) ); ?>" class="scroll-mt-24 border-b border-border bg-secondary/40">
        <div class="mx-auto max-w-[86rem] px-5 py-20 md:px-10">
            <div class="es-reveal">
                <p class="font-mono-plex text-xs uppercase tracking-[0.24em] text-[hsl(var(--accent))]"><?php es_ui_t( 'secciones.trabajo' ); ?></p>
                <h2 class="mt-4 max-w-2xl font-display text-3xl font-bold leading-tight sm:text-5xl"><?php es_ui_t( 'secciones.trabajoTitulo' ); ?></h2>
            </div>

            <div class="mt-14 space-y-14 md:space-y-20">
                <?php foreach ( $proyectos as $i => $p ) : ?>
                    <div class="es-reveal">
                        <article class="grid items-center gap-8 md:grid-cols-2 md:gap-14 <?php echo $i % 2 === 1 ? 'md:[&>figure]:order-2' : ''; ?>">
                            <figure class="group relative overflow-hidden bg-background">
                                <?php if ( ! empty( $p['image'] ) ) : ?>
                                    <img src="<?php echo esc_url( $p['image'] ); ?>" alt="<?php echo esc_attr( $p['title'] ); ?>" loading="lazy" class="aspect-[3/2] w-full object-cover grayscale transition-all duration-500 group-hover:grayscale-0 group-hover:scale-[1.03]" />
                                <?php else : ?>
                                    <div class="grid aspect-[3/2] w-full place-items-center bg-[hsl(var(--ink))] text-primary-foreground">
                                        <span class="font-display text-5xl font-bold opacity-20"><?php echo esc_html( str_pad( $i + 1, 2, '0', STR_PAD_LEFT ) ); ?></span>
                                    </div>
                                <?php endif; ?>
                                <figcaption class="absolute left-0 top-0 bg-[hsl(var(--ink))] px-3 py-1.5 font-mono-plex text-[11px] uppercase tracking-[0.16em] text-primary-foreground"><?php echo esc_html( $p['year'] ); ?></figcaption>
                            </figure>
                            <div>
                                <p class="font-mono-plex text-[11px] uppercase tracking-[0.18em] text-muted-foreground"><?php es_t( $p['type'] ); ?></p>
                                <h3 class="mt-3 font-display text-2xl font-bold sm:text-4xl"><?php echo esc_html( $p['title'] ); ?></h3>
                                <p class="mt-4 max-w-lg text-base leading-relaxed text-muted-foreground"><?php es_t( $p['summary'] ); ?></p>
                                <ul class="mt-5 flex flex-wrap gap-2">
                                    <?php foreach ( $p['stack'] as $st ) : ?>
                                        <li class="border border-border px-2.5 py-1 font-mono-plex text-[11px] uppercase tracking-[0.12em] text-muted-foreground"><?php echo esc_html( $st ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php if ( ! empty( $p['link'] ) ) : ?>
                                    <a href="<?php echo esc_url( $p['link'] ); ?>" target="_blank" rel="noreferrer" class="mt-6 inline-flex items-center gap-2 font-mono-plex text-xs uppercase tracking-[0.16em] underline decoration-[hsl(var(--accent))] decoration-2 underline-offset-4">
                                        <?php es_ui_t( 'misc.verMas' ); ?> <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- TRAYECTORIA -->
    <section class="border-b border-border">
        <div class="mx-auto grid max-w-[86rem] gap-14 px-5 py-20 md:grid-cols-[1.3fr_0.7fr] md:px-10">
            <div>
                <div class="es-reveal">
                    <p class="font-mono-plex text-xs uppercase tracking-[0.24em] text-[hsl(var(--accent))]"><?php es_ui_t( 'secciones.trayectoria' ); ?></p>
                    <h2 class="mt-4 font-display text-3xl font-bold leading-tight sm:text-5xl"><?php es_ui_t( 'secciones.trayectoriaTitulo' ); ?></h2>
                </div>
                <ol class="mt-10 border-l border-border pl-6">
                    <?php foreach ( $experiencia as $i => $e ) : ?>
                        <li class="es-reveal relative pb-10">
                            <span class="absolute -left-[1.9rem] top-1.5 h-2.5 w-2.5 bg-[hsl(var(--accent))]"></span>
                            <p class="font-mono-plex text-[11px] uppercase tracking-[0.16em] text-muted-foreground"><?php es_t( $e['period'] ); ?></p>
                            <h3 class="mt-1.5 font-display text-xl font-semibold"><?php es_t( $e['position'] ); ?></h3>
                            <p class="text-sm text-muted-foreground"><?php es_t( $e['company'] ); ?></p>
                            <?php
                            es_t_list( $e['details']['es'], $e['details']['en'], 'ul', 'mt-3 space-y-1.5 text-sm text-muted-foreground', function( $d ) {
                                echo '<li>— ' . esc_html( $d ) . '</li>';
                            } );
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>

            <div class="es-reveal">
                <aside class="border border-[hsl(var(--ink))] bg-[hsl(var(--ink))] p-8 text-[hsl(40_20%_94%)]">
                    <p class="font-mono-plex text-[11px] uppercase tracking-[0.18em] text-[hsl(var(--accent))]"><?php es_ui_t( 'cv.actualizado' ); ?></p>
                    <h3 class="mt-3 font-display text-2xl font-semibold leading-snug">
                        <?php es_t( [ 'es' => 'CV completo, listo para imprimir o guardar en PDF', 'en' => 'Full CV, ready to print or save as PDF' ] ); ?>
                    </h3>
                    <p class="mt-3 text-sm text-[hsl(40_10%_70%)]">
                        <?php es_t( [ 'es' => 'Experiencia, formación y stack en una sola página.', 'en' => 'Experience, education and stack on a single page.' ] ); ?>
                    </p>
                    <a href="<?php echo esc_url( es_page_url( 'cv' ) ); ?>" class="mt-6 inline-flex min-h-[48px] items-center gap-2 bg-[hsl(var(--accent))] px-5 font-mono-plex text-xs uppercase tracking-[0.16em] text-accent-foreground transition-transform active:scale-[0.98]">
                        <i data-lucide="download" class="h-4 w-4"></i> <?php es_ui_t( 'cv.descargar' ); ?>
                    </a>
                    <ul class="mt-8 flex flex-wrap gap-2">
                        <?php foreach ( $habilidades as $h ) : ?>
                            <li class="border border-white/20 px-2.5 py-1 font-mono-plex text-[11px] uppercase tracking-[0.12em] text-[hsl(40_10%_78%)]"><?php echo esc_html( $h ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </aside>
            </div>
        </div>
    </section>

    <!-- BLOG preview -->
    <section class="border-b border-border bg-secondary/40">
        <div class="mx-auto max-w-[80rem] px-5 py-20 md:px-10">
            <div class="es-reveal flex flex-wrap items-end justify-between gap-6">
                <div>
                    <p class="font-mono-plex text-xs uppercase tracking-[0.24em] text-[hsl(var(--accent))]"><?php es_ui_t( 'secciones.blog' ); ?></p>
                    <h2 class="mt-4 max-w-2xl font-display text-3xl font-bold leading-tight sm:text-5xl"><?php es_ui_t( 'secciones.blogTitulo' ); ?></h2>
                </div>
                <a href="<?php echo esc_url( es_page_url( 'blog' ) ); ?>" class="inline-flex items-center gap-2 font-mono-plex text-xs uppercase tracking-[0.16em] underline decoration-[hsl(var(--accent))] decoration-2 underline-offset-4">
                    <?php es_ui_t( 'misc.verTodos' ); ?> <i data-lucide="arrow-right" class="h-4 w-4"></i>
                </a>
            </div>

            <?php $es_home_posts = new WP_Query( [ 'post_type' => 'post', 'posts_per_page' => 2, 'ignore_sticky_posts' => true ] ); ?>
            <?php if ( $es_home_posts->have_posts() ) : ?>
                <div class="es-reveal mt-12 grid gap-px border border-border bg-border md:grid-cols-2">
                    <?php while ( $es_home_posts->have_posts() ) : $es_home_posts->the_post(); ?>
                        <article class="flex h-full flex-col bg-background p-8">
                            <p class="font-mono-plex text-[11px] uppercase tracking-[0.16em] text-muted-foreground"><?php echo esc_html( get_the_date() ); ?></p>
                            <h3 class="mt-4 font-display text-xl font-semibold leading-snug"><a href="<?php the_permalink(); ?>" class="hover:text-[hsl(var(--accent))]"><?php the_title(); ?></a></h3>
                            <p class="mt-3 text-sm leading-relaxed text-muted-foreground"><?php echo esc_html( get_the_excerpt() ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="mt-auto inline-flex items-center gap-2 pt-7 font-mono-plex text-xs uppercase tracking-[0.16em] underline decoration-[hsl(var(--accent))] decoration-2 underline-offset-4">
                                <?php es_ui_t( 'blogPage.leer' ); ?> <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                            </a>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CONTACTO -->
    <section id="<?php echo esc_attr( es_anchor( 'contacto' ) ); ?>" class="scroll-mt-24">
        <div class="mx-auto max-w-[72rem] px-5 py-24 md:px-10">
            <div class="es-reveal">
                <p class="font-mono-plex text-xs uppercase tracking-[0.24em] text-[hsl(var(--accent))]"><?php es_ui_t( 'secciones.contacto' ); ?></p>
                <h2 class="mt-4 max-w-3xl font-display text-3xl font-bold leading-[1.05] sm:text-5xl lg:text-6xl"><?php es_ui_t( 'secciones.contactoTitulo' ); ?></h2>
                <p class="mt-6 max-w-xl text-lg text-muted-foreground"><?php es_ui_t( 'secciones.contactoTexto' ); ?></p>
            </div>
            <div class="mt-10 flex flex-wrap gap-3">
                <a href="mailto:<?php echo esc_attr( $perfil['email'] ); ?>" class="inline-flex min-h-[52px] items-center gap-2 bg-[hsl(var(--ink))] px-7 font-mono-plex text-xs uppercase tracking-[0.16em] text-primary-foreground transition-transform active:scale-[0.98]">
                    <i data-lucide="mail" class="h-4 w-4"></i> <?php echo esc_html( $perfil['email'] ); ?>
                </a>
                <a href="<?php echo esc_url( $perfil['linkedin'] ); ?>" target="_blank" rel="noreferrer" class="inline-flex min-h-[52px] items-center gap-2 border border-[hsl(var(--ink))] px-7 font-mono-plex text-xs uppercase tracking-[0.16em] transition-colors hover:bg-secondary">
                    <i data-lucide="linkedin" class="h-4 w-4"></i> LinkedIn
                </a>
                <a href="<?php echo esc_url( $perfil['github'] ); ?>" target="_blank" rel="noreferrer" class="inline-flex min-h-[52px] items-center gap-2 border border-[hsl(var(--ink))] px-7 font-mono-plex text-xs uppercase tracking-[0.16em] transition-colors hover:bg-secondary">
                    <i data-lucide="github" class="h-4 w-4"></i> GitHub
                </a>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>
