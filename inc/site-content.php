<?php
/**
 * Contenido editable del sitio.
 *
 * Este archivo reemplaza a "data/site.js" del sitio original.
 * Para editar textos, fechas, proyectos, cursos, experiencia, etc.
 * NO hace falta tocar ningún otro archivo del tema: todo vive acá,
 * en simples arrays de PHP.
 *
 * Cada campo bilingüe se escribe como ['es' => '...', 'en' => '...'].
 * Si un campo es solo texto (sin 'es'/'en'), se muestra igual en los dos idiomas.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function es_perfil() {
    return [
        'nombre'    => 'Eduardo Seelig',
        'iniciales' => 'ES',
        'ubicacion' => [ 'es' => 'Argentina · Remoto', 'en' => 'Argentina · Remote' ],
        'rol'       => [ 'es' => 'Ingeniero de Software · CTO · Full Stack', 'en' => 'Software Engineer · CTO · Full Stack' ],
        'email'     => 'hola@eduardoseelig.com.ar',
        'website'   => 'https://www.eduardoseelig.com.ar',
        'github'    => 'https://github.com/educolo',
        'linkedin'  => 'https://www.linkedin.com/in/eduseelig/',
        'foto'      => 'https://avatars.githubusercontent.com/u/446912?v=4',
        'resumen'   => [
            'es' => 'Ingeniero de software con más de dos décadas construyendo producto digital de punta a punta: desde la arquitectura y el código hasta la decisión de qué construir y por qué. Trabajo en la intersección entre ingeniería, producto e IA, ayudando a equipos y emprendedores a no confundir software con producto.',
            'en' => 'Software engineer with over two decades building digital product end to end: from architecture and code to the decision of what to build and why. I work at the intersection of engineering, product and AI, helping teams and founders avoid confusing software with product.',
        ],
    ];
}

function es_enfoque() {
    return [
        [
            'id' => 'producto',
            'icon' => 'layers',
            'titulo' => [ 'es' => 'Producto antes que software', 'en' => 'Product before software' ],
            'promesa' => [
                'es' => 'Acompaño la decisión de qué construir y por qué, antes de escribir una línea de código. El software sirve cuando responde a una necesidad real.',
                'en' => 'I help decide what to build and why, before writing a single line of code. Software only matters when it answers a real need.',
            ],
            'entregables' => [
                'es' => [ 'Descubrimiento y definición', 'Prototipos navegables', 'Roadmap técnico priorizado', 'Validación con usuarios' ],
                'en' => [ 'Discovery & definition', 'Navigable prototypes', 'Prioritized technical roadmap', 'User validation' ],
            ],
        ],
        [
            'id' => 'ingenieria',
            'icon' => 'code',
            'titulo' => [ 'es' => 'Ingeniería full stack', 'en' => 'Full-stack engineering' ],
            'promesa' => [
                'es' => 'Arquitectura y desarrollo de plataformas web y APIs: código mantenible, decisiones documentadas y bases que escalan con el equipo.',
                'en' => 'Architecture and development of web platforms and APIs: maintainable code, documented decisions and foundations that scale with the team.',
            ],
            'entregables' => [
                'es' => [ 'Aplicaciones web con React y Node', 'APIs y modelado de datos', 'Integraciones y automatizaciones', 'Revisión de arquitectura' ],
                'en' => [ 'Web apps with React & Node', 'APIs & data modeling', 'Integrations & automations', 'Architecture review' ],
            ],
        ],
        [
            'id' => 'ia',
            'icon' => 'sparkles',
            'titulo' => [ 'es' => 'IA aplicada al producto', 'en' => 'AI applied to product' ],
            'promesa' => [
                'es' => 'Integración de modelos de IA en flujos reales: no demos, sino funciones que ahorran tiempo o desbloquean capacidades nuevas.',
                'en' => 'Integrating AI models into real workflows: not demos, but features that save time or unlock new capabilities.',
            ],
            'entregables' => [
                'es' => [ 'Casos de uso con impacto medible', 'Integración de LLMs y APIs', 'Prompts y evaluación', 'Prototipos funcionales' ],
                'en' => [ 'Use cases with measurable impact', 'LLM & API integration', 'Prompts & evaluation', 'Functional prototypes' ],
            ],
        ],
    ];
}

function es_proyectos() {
    return [
        [
            'titulo' => 'Psychopharmacology Institute',
            'tipo' => [ 'es' => 'Plataforma · CTO', 'en' => 'Platform · CTO' ],
            'anio' => '2020 — actualidad',
            'resumen' => [
                'es' => 'Liderazgo tecnológico de una plataforma de educación e investigación en psiquiatría: arquitectura, equipo y roadmap de producto.',
                'en' => 'Technology leadership of an education and research platform in psychiatry: architecture, team and product roadmap.',
            ],
            'stack' => [ 'Full Stack', 'CTO', 'Producto', 'IA' ],
            'enlace' => 'https://www.linkedin.com/in/eduseelig/',
        ],
        [
            'titulo' => 'wp-plugin-fw',
            'tipo' => [ 'es' => 'Open source · Framework', 'en' => 'Open source · Framework' ],
            'anio' => 'GitHub',
            'resumen' => [
                'es' => 'Framework para construir plugins de WordPress más rápido y mejor: abstracciones reutilizables para desarrolladores.',
                'en' => 'A framework to build WordPress plugins faster and better: reusable abstractions for developers.',
            ],
            'stack' => [ 'PHP', 'WordPress', 'Framework' ],
            'enlace' => 'https://github.com/educolo/wp-plugin-fw',
        ],
        [
            'titulo' => 'Práctica independiente',
            'tipo' => [ 'es' => 'Consultoría · Full Stack', 'en' => 'Consulting · Full Stack' ],
            'anio' => '2003 — actualidad',
            'resumen' => [
                'es' => 'Desarrollo full stack autónomo para clientes diversos: web, APIs, integraciones y modelado 3D aplicado a producto.',
                'en' => 'Autonomous full-stack development for diverse clients: web, APIs, integrations and 3D modeling applied to product.',
            ],
            'stack' => [ 'Full Stack', 'Web', 'APIs', '3D' ],
            'enlace' => 'https://www.eduardoseelig.com.ar',
        ],
        [
            'titulo' => 'jugando_a_tdd',
            'tipo' => [ 'es' => 'Open source · Práctica', 'en' => 'Open source · Practice' ],
            'anio' => 'GitHub',
            'resumen' => [
                'es' => 'Repositorio de prácticas de TDD y patrones de diseño: aprendizaje en público y ejercicios reproducibles.',
                'en' => 'Repository of TDD practice and design patterns: learning in public and reproducible exercises.',
            ],
            'stack' => [ 'Python', 'TDD', 'Patrones' ],
            'enlace' => 'https://github.com/educolo/jugando_a_tdd',
        ],
    ];
}

function es_cursos() {
    return [
        [
            'titulo' => [ 'es' => 'Producto vs. software: la trampa más común', 'en' => 'Product vs. software: the most common trap' ],
            'nivel' => [ 'es' => 'Lectura', 'en' => 'Read' ],
            'formato' => [ 'es' => 'Ensayo', 'en' => 'Essay' ],
            'temas' => [ 'es' => [ 'Descubrimiento', 'Priorización', 'Validación' ], 'en' => [ 'Discovery', 'Prioritization', 'Validation' ] ],
            'descripcion' => [
                'es' => 'Notas sobre por qué tantos proyectos fallan no por código malo, sino por construir lo equivocado.',
                'en' => 'Notes on why so many projects fail not from bad code, but from building the wrong thing.',
            ],
        ],
        [
            'titulo' => [ 'es' => 'TDD sin dogmas', 'en' => 'TDD without dogma' ],
            'nivel' => [ 'es' => 'Práctico', 'en' => 'Hands-on' ],
            'formato' => [ 'es' => 'Tutorial', 'en' => 'Tutorial' ],
            'temas' => [ 'es' => [ 'Ciclo rojo-verde', 'Patrones', 'Refactor' ], 'en' => [ 'Red-green cycle', 'Patterns', 'Refactor' ] ],
            'descripcion' => [
                'es' => 'Cómo uso TDD en proyectos reales sin convertirlo en religión: cuándo ayuda y cuándo estorba.',
                'en' => 'How I use TDD on real projects without turning it into religion: when it helps and when it gets in the way.',
            ],
        ],
        [
            'titulo' => [ 'es' => 'IA aplicada: del demo a la función', 'en' => 'Applied AI: from demo to feature' ],
            'nivel' => [ 'es' => 'Intermedio', 'en' => 'Intermediate' ],
            'formato' => [ 'es' => 'Guía', 'en' => 'Guide' ],
            'temas' => [ 'es' => [ 'Casos de uso', 'LLMs', 'Evaluación' ], 'en' => [ 'Use cases', 'LLMs', 'Evaluation' ] ],
            'descripcion' => [
                'es' => 'El camino desde una demo llamativa hasta una función que aporta valor medible en el producto.',
                'en' => 'The path from a flashy demo to a feature that delivers measurable value in the product.',
            ],
        ],
        [
            'titulo' => [ 'es' => 'Arquitectura para equipos pequeños', 'en' => 'Architecture for small teams' ],
            'nivel' => [ 'es' => 'Intermedio', 'en' => 'Intermediate' ],
            'formato' => [ 'es' => 'Guía', 'en' => 'Guide' ],
            'temas' => [ 'es' => [ 'Monolito modular', 'APIs', 'Datos' ], 'en' => [ 'Modular monolith', 'APIs', 'Data' ] ],
            'descripcion' => [
                'es' => 'Decisiones de arquitectura que sostienen un equipo chico sin ahogarlo en complejidad prematura.',
                'en' => 'Architecture decisions that sustain a small team without drowning it in premature complexity.',
            ],
        ],
        [
            'titulo' => [ 'es' => 'WordPress como plataforma de producto', 'en' => 'WordPress as a product platform' ],
            'nivel' => [ 'es' => 'Práctico', 'en' => 'Hands-on' ],
            'formato' => [ 'es' => 'Tutorial', 'en' => 'Tutorial' ],
            'temas' => [ 'es' => [ 'Plugins', 'Framework', 'Custom post types' ], 'en' => [ 'Plugins', 'Framework', 'Custom post types' ] ],
            'descripcion' => [
                'es' => 'Construir sobre WordPress sin pelearse con él: estructura de plugins y abstracciones útiles.',
                'en' => 'Building on WordPress without fighting it: plugin structure and useful abstractions.',
            ],
        ],
        [
            'titulo' => [ 'es' => 'Aprender en público', 'en' => 'Learning in public' ],
            'nivel' => [ 'es' => 'Lectura', 'en' => 'Read' ],
            'formato' => [ 'es' => 'Ensayo', 'en' => 'Essay' ],
            'temas' => [ 'es' => [ 'Comunidad', 'Notas', 'Hábito' ], 'en' => [ 'Community', 'Notes', 'Habit' ] ],
            'descripcion' => [
                'es' => 'Por qué documentar lo que aprendes acelera tu crecimiento y construye una red a la vez.',
                'en' => 'Why documenting what you learn accelerates your growth and builds a network at the same time.',
            ],
        ],
    ];
}

function es_experiencia() {
    return [
        [
            'puesto' => [ 'es' => 'Chief Technology Officer', 'en' => 'Chief Technology Officer' ],
            'empresa' => 'Psychopharmacology Institute',
            'periodo' => '2020 — actualidad',
            'detalles' => [
                'es' => [
                    'Responsable de arquitectura, equipo de ingeniería y roadmap técnico de la plataforma.',
                    'Definición de prioridades de producto junto al equipo de contenido y educación.',
                    'Integración de IA en flujos de aprendizaje e investigación.',
                ],
                'en' => [
                    'Responsible for architecture, engineering team and technical roadmap of the platform.',
                    'Defining product priorities alongside the content and education team.',
                    'Integrating AI into learning and research workflows.',
                ],
            ],
        ],
        [
            'puesto' => [ 'es' => 'Desarrollador Full Stack (autónomo)', 'en' => 'Full Stack Developer (independent)' ],
            'empresa' => [ 'es' => 'Práctica propia', 'en' => 'Independent practice' ],
            'periodo' => '2003 — actualidad',
            'detalles' => [
                'es' => [
                    'Desarrollo web full stack, APIs e integraciones para clientes en distintos rubros.',
                    'Consultoría de producto: ayudar a decidir qué construir antes de cómo.',
                    'Modelado 3D y texturizado aplicado a producto y experiencias digitales.',
                ],
                'en' => [
                    'Full-stack web development, APIs and integrations for clients across industries.',
                    'Product consulting: helping decide what to build before how.',
                    '3D modeling and texturing applied to product and digital experiences.',
                ],
            ],
        ],
        [
            'puesto' => [ 'es' => 'Software Engineer', 'en' => 'Software Engineer' ],
            'empresa' => [ 'es' => 'Diversas empresas', 'en' => 'Various companies' ],
            'periodo' => [ 'es' => 'Trayectoria previa', 'en' => 'Earlier career' ],
            'detalles' => [
                'es' => [
                    'Roles de ingeniería de software en equipos de producto.',
                    'Construcción y mantenimiento de plataformas web y servicios.',
                ],
                'en' => [
                    'Software engineering roles across product teams.',
                    'Building and maintaining web platforms and services.',
                ],
            ],
        ],
    ];
}

function es_educacion() {
    return [
        [
            'titulo' => [ 'es' => 'Formación en ingeniería de software y desarrollo de producto', 'en' => 'Background in software engineering and product development' ],
            'lugar' => [ 'es' => 'Autodidacta + práctica profesional continua', 'en' => 'Self-taught + continuous professional practice' ],
            'periodo' => '2003 — actualidad',
        ],
        [
            'titulo' => [ 'es' => 'Patrones de diseño y TDD', 'en' => 'Design patterns & TDD' ],
            'lugar' => [ 'es' => 'Práctica deliberada · repositorios públicos', 'en' => 'Deliberate practice · public repositories' ],
            'periodo' => 'GitHub',
        ],
    ];
}

function es_habilidades() {
    return [ 'React', 'Node.js', 'JavaScript', 'PHP', 'WordPress', 'Python', 'PostgreSQL', 'MySQL', 'Docker', 'AWS', 'IA / LLMs', 'Producto', 'Arquitectura', 'TDD', 'Git', '3D' ];
}

/** Items del ticker animado del header del home (subset elegido a mano, igual que el original). */
function es_habilidades_ticker() {
    return [ 'React', 'Node.js', 'JavaScript', 'PHP', 'WordPress', 'Python', 'PostgreSQL', 'Docker', 'AWS', 'IA / LLMs', 'Producto', 'TDD', 'Arquitectura', 'Git' ];
}
