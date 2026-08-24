<?php
/**
 * Contenido editable del sitio.
 *
 * Este archivo reemplaza a "data/site.js" del sitio original.
 * Para editar textos, fechas, proyectos, experiencia, etc.
 * NO hace falta tocar ningún otro archivo del tema: todo vive acá,
 * en simples arrays de PHP.
 *
 * Cada campo bilingüe se escribe como ['es' => '...', 'en' => '...'].
 * Si un campo es solo texto (sin 'es'/'en'), se muestra igual en los dos idiomas.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function es_perfil() {
    return [
        'name'    => 'Eduardo Seelig',
        'initials' => 'ES',
        'location' => [ 'es' => 'Argentina · Remoto', 'en' => 'Argentina · Remote' ],
        'role'       => [ 'es' => 'Desarrollador de Software · Backend en Python', 'en' => 'Software Engineer · Python Backend' ],
        'email'     => 'hola@eduardoseelig.com.ar',
        'website'   => 'https://www.eduardoseelig.com.ar',
        'github'    => 'https://github.com/educolo',
        'linkedin'  => 'https://www.linkedin.com/in/eduseelig/',
        'photo'      => 'https://avatars.githubusercontent.com/u/446912?v=4',
        'summary'   => [
            'es' => 'Desarrollador de software con 20 años de experiencia en IT y más de 10 especializado en desarrollo backend con Python (Django, Flask y FastAPI). Amplia experiencia diseñando sistemas backend escalables y de alto rendimiento, arquitecturas asíncronas, APIs REST y bases de datos relacionales. A lo largo de mi carrera trabajé en startups y consultoría de software, con roles que van de Backend Engineer a CTO, lo que me dio una comprensión sólida de los desafíos técnicos y de negocio. Más allá del desarrollo, contribuí en decisiones de arquitectura, estándares de ingeniería, calidad de código, flujos de trabajo y procesos de despliegue. Con experiencia en entornos ágiles (Scrum), mentoría técnica y colaboración cross-funcional con producto, ingeniería y clientes en inglés. Me apasiona construir software confiable, mantenible y seguro, ayudando a los equipos a mejorar sus prácticas y entregar productos de calidad.',
            'en' => 'Software Engineer with 20 years of experience in IT and over 10 years specializing in Python backend development using Django, Flask, and FastAPI. Extensive experience designing scalable, high-performance backend systems, asynchronous architectures, REST APIs, and relational databases. Throughout my career, I have worked in startups and software consulting, taking on roles ranging from Backend Engineer to CTO, which has given me a strong understanding of both technical and business challenges. Beyond software development, I have contributed to architecture decisions, engineering standards, code quality initiatives, development workflows, and deployment processes. Experienced in Agile (Scrum) environments, technical mentoring, and cross-functional collaboration with product, engineering, and clients in English. Passionate about building reliable, maintainable, and secure software while helping teams improve engineering practices and deliver high-quality products.',
        ],
    ];
}

function es_enfoque() {
    return [
        [
            'id' => 'producto',
            'icon' => 'layers',
            'title' => [ 'es' => 'Producto antes que software', 'en' => 'Product before software' ],
            'promise' => [
                'es' => 'Acompaño la decisión de qué construir y por qué, antes de escribir una línea de código. El software sirve cuando responde a una necesidad real.',
                'en' => 'I help decide what to build and why, before writing a single line of code. Software only matters when it answers a real need.',
            ],
            'deliverables' => [
                'es' => [ 'Descubrimiento y definición', 'Prototipos navegables', 'Roadmap técnico priorizado', 'Validación con usuarios' ],
                'en' => [ 'Discovery & definition', 'Navigable prototypes', 'Prioritized technical roadmap', 'User validation' ],
            ],
        ],
        [
            'id' => 'ingenieria',
            'icon' => 'code',
            'title' => [ 'es' => 'Ingeniería full stack', 'en' => 'Full-stack engineering' ],
            'promise' => [
                'es' => 'Arquitectura y desarrollo de plataformas web y APIs: código mantenible, decisiones documentadas y bases que escalan con el equipo.',
                'en' => 'Architecture and development of web platforms and APIs: maintainable code, documented decisions and foundations that scale with the team.',
            ],
            'deliverables' => [
                'es' => [ 'Backend y APIs con Python (Django, FastAPI)', 'APIs y modelado de datos', 'Integraciones y automatizaciones', 'Revisión de arquitectura' ],
                'en' => [ 'Backend & APIs with Python (Django, FastAPI)', 'APIs & data modeling', 'Integrations & automations', 'Architecture review' ],
            ],
        ],
        [
            'id' => 'ia',
            'icon' => 'sparkles',
            'title' => [ 'es' => 'IA aplicada al producto', 'en' => 'AI applied to product' ],
            'promise' => [
                'es' => 'Integración de modelos de IA en flujos reales: no demos, sino funciones que ahorran tiempo o desbloquean capacidades nuevas.',
                'en' => 'Integrating AI models into real workflows: not demos, but features that save time or unlock new capabilities.',
            ],
            'deliverables' => [
                'es' => [ 'Casos de uso con impacto medible', 'Integración de LLMs y APIs', 'Prompts y evaluación', 'Prototipos funcionales' ],
                'en' => [ 'Use cases with measurable impact', 'LLM & API integration', 'Prompts & evaluation', 'Functional prototypes' ],
            ],
        ],
    ];
}

function es_proyectos() {
    /*
     * Campo opcional 'image':
     *   - Para una imagen incluida en el tema, guardala en assets/img/ y usá:
     *       ES_THEME_URI . '/assets/img/archivo.jpg'
     *   - También sirve una URL absoluta (p. ej. de la biblioteca de medios).
     *   - La imagen se muestra en blanco y negro y pasa a color al pasar el mouse.
     *   - Si dejás el campo vacío ('') o lo borrás, se usa el recuadro negro con el
     *     número, tal como está actualmente.
     *   - Recomendado: JPG en 3:2 (~1200x800) y optimizado para que pese poco.
     */
    return [
        [
            'title' => 'Wellnest',
            'image' => ES_THEME_URI . '/assets/img/wellnest.jpg', // URL de imagen opcional; vacío = recuadro negro
            'type' => [ 'es' => 'Plataforma de salud · Backend Engineer', 'en' => 'Healthcare platform · Backend Engineer' ],
            'year' => '2025 — 2026',
            'summary' => [
                'es' => 'Plataforma de salud HIPAA-compliant que integra dispositivos wearables para recolectar signos vitales, generar insights de salud y disparar alertas para pacientes, cuidadores y profesionales. Incluye una app móvil para pacientes y un portal web para médicos. Desarrollé las APIs REST asíncronas con FastAPI, la integración con wearables (Terra), pagos con Stripe y autenticación con Auth0.',
                'en' => 'A HIPAA-compliant healthcare platform that integrates wearable devices to collect patient vital signs, generate health insights, and trigger alerts for patients, caregivers, and healthcare professionals. It includes a patient mobile app and a physician web portal. I built the asynchronous REST APIs with FastAPI, the wearable integration (Terra), payments with Stripe, and authentication with Auth0.',
            ],
            'stack' => [ 'Python', 'FastAPI', 'PostgreSQL', 'Celery', 'AWS' ],
            'link' => 'https://www.hellowellnest.com/en',
        ],
        [
            'title' => 'Psychopharmacology Institute',
            'image' => ES_THEME_URI . '/assets/img/psychopharmacology.jpg', // URL de imagen opcional; vacío = recuadro negro
            'type' => [ 'es' => 'Plataforma de educación · CTO', 'en' => 'Education platform · CTO' ],
            'year' => '2020 — 2022',
            'summary' => [
                'es' => 'Plataforma de educación e investigación en psicofarmacología. Como CTO lideré arquitectura, seguridad e infraestructura de un backend Python/Django con frontend React (AWS Elastic Beanstalk, S3 + CloudFront, MySQL RDS). Migré procesos pesados a AWS Lambda y llevé al equipo a reducir errores del 23% al 0,02% en picos de tráfico.',
                'en' => 'An education and research platform on psychopharmacology. As CTO I led architecture, security, and infrastructure of a Python/Django backend with a React frontend (AWS Elastic Beanstalk, S3 + CloudFront, MySQL RDS). I moved heavy processes to AWS Lambda and led the team to reduce errors from 23% to 0.02% during traffic peaks.',
            ],
            'stack' => [ 'Python', 'Django', 'React', 'AWS', 'MySQL' ],
            'link' => 'https://psychopharmacologyinstitute.com/',
        ],
    ];
}

function es_experiencia() {
    return [
        [
            'position' => [ 'es' => 'Backend Engineer', 'en' => 'Backend Engineer' ],
            'company' => 'Rootstrap · Wellnest',
            'period' => [ 'es' => 'Nov 2025 — Jul 2026', 'en' => 'Nov 2025 — Jul 2026' ],
            'details' => [
                'es' => [
                    'Desarrollo backend de una plataforma de salud HIPAA-compliant que integra dispositivos wearables para recolectar signos vitales, generar insights de salud y disparar alertas para pacientes, cuidadores y profesionales de la salud.',
                    'Diseño y desarrollo de APIs REST asíncronas de alto rendimiento con FastAPI y acceso asíncrono a base de datos.',
                    'Integración con Terra para sincronizar datos de salud de múltiples proveedores de wearables; pipelines en segundo plano con Celery (ingesta, alertas, notificaciones, emails y tareas programadas).',
                    'Procesamiento de pagos y suscripciones con Stripe y autenticación con Auth0, gestionando roles y permisos en la base de datos local.',
                    'Diseño e implementación de servicios backend seguros y HIPAA-compliant para manejar información de salud protegida (PHI), colaborando con producto e ingeniería en la evolución de la plataforma.',
                ],
                'en' => [
                    'Backend development of a HIPAA-compliant healthcare platform integrating wearable devices to collect patient vital signs, generate health insights, and trigger alerts for patients, caregivers, and healthcare professionals.',
                    'Designed and developed high-performance asynchronous REST APIs using FastAPI with asynchronous database access.',
                    'Integrated the platform with Terra to synchronize health data from multiple wearable providers; background pipelines with Celery (ingestion, alerts, notifications, emails, and scheduled tasks).',
                    'Implemented payment and subscription management with Stripe and authentication with Auth0, managing application roles and permissions in the local database.',
                    'Designed and implemented secure, HIPAA-compliant backend services for handling protected health information (PHI), working closely with product and engineering on the platform evolution.',
                ],
            ],
        ],
        [
            'position' => [ 'es' => 'Fullstack Developer', 'en' => 'Fullstack Developer' ],
            'company' => 'Rootstrap · Rickhouse / Consigliere',
            'period' => [ 'es' => 'Ene 2025 — Oct 2025', 'en' => 'Jan 2025 — Oct 2025' ],
            'details' => [
                'es' => [
                    'Herramienta de análisis de reseñas con ML/IA orientada al cliente, construida con Django/Python, PostgreSQL y frontend React.',
                    'Desarrollo y mantenimiento de APIs de datos: nuevas features y mejoras de rendimiento y usabilidad.',
                    'Trabajo con modelos de IA generativa alimentados con datasets propios para generar nuevas entidades en el sistema.',
                    'Construcción de un chatbot con IA que da respuestas contextuales según el contenido mostrado al usuario.',
                    'Desde julio 2025, único Fullstack Developer del producto; lideré el rebranding completo de Rickhouse a Consigliere (aplicación y documentación).',
                ],
                'en' => [
                    'Client-facing ML/AI review analysis tool built with Django/Python, PostgreSQL, and a React frontend.',
                    'Developed and maintained data APIs, creating new features and enhancing existing ones to improve performance and usability.',
                    'Worked on generative AI models, feeding them with proprietary datasets to generate new entities within the system.',
                    'Built a simple AI-powered chatbot providing contextual responses based on the content displayed to the user.',
                    'Since July 2025, became the sole Fullstack Developer; led a full rebranding initiative from Rickhouse to Consigliere (application and documentation).',
                ],
            ],
        ],
        [
            'position' => [ 'es' => 'Python Developer', 'en' => 'Python Developer' ],
            'company' => 'Rootstrap · Kinimatic',
            'period' => [ 'es' => 'Dic 2024 — Ene 2025', 'en' => 'Dec 2024 — Jan 2025' ],
            'details' => [
                'es' => [
                    'Mantenimiento, mejoras y desarrollo de nuevas features en aplicaciones Python y Python/Flask; refactor y mejora de código.',
                    'Herramienta de data-pipeline para obtener datos de APIs de terceros o archivos e insertarlos en el sistema (app Python con lambdas como workers).',
                    'API REST en Flask que expone al front-end los datos recolectados por el pipeline.',
                ],
                'en' => [
                    'Maintenance, enhancements, and development of new Python and Python/Flask application features; refactoring and improving the code.',
                    'Data-pipeline tool to get data from 3rd party APIs or data files and insert them into the system (a Python app using lambdas as workers).',
                    'Flask REST API that exposes the data collected by the pipeline to the front-end website.',
                ],
            ],
        ],
        [
            'position' => [ 'es' => 'Backend Developer', 'en' => 'Backend Developer' ],
            'company' => 'KIU Systems',
            'period' => [ 'es' => 'Ago 2023 — Dic 2024', 'en' => 'Aug 2023 — Dec 2024' ],
            'details' => [
                'es' => [
                    'Mantenimiento, mejoras y nuevas features en aplicaciones Django y Flask (proyecto Payments).',
                    'Integración de gateways de pago en una app de pagos Django, creando SDKs pequeños para interacciones eficientes.',
                    'Mantenimiento y testing de las funcionalidades core de la aplicación de pagos.',
                    'Nuevo front-end de un producto con Vue sobre el framework core de la empresa; fixes y mejoras en un backend construido con FastAPI.',
                ],
                'en' => [
                    'Maintenance, enhancements, and development of new features for Django and Flask applications (Payments project).',
                    'Integrated payment gateways into a Django-based payment application, creating small SDKs for efficient interactions.',
                    'Maintained and tested the core functionalities of the payment application.',
                    'Developed a new front-end for a product using Vue on the company core framework; implemented fixes and improvements on a FastAPI backend.',
                ],
            ],
        ],
        [
            'position' => [ 'es' => 'Full Stack Developer (freelance)', 'en' => 'Full Stack Developer (freelance)' ],
            'company' => [ 'es' => 'Práctica independiente', 'en' => 'Independent practice' ],
            'period' => [ 'es' => 'Ene 2003 — Dic 2023', 'en' => 'Jan 2003 — Dec 2023' ],
            'details' => [
                'es' => [
                    'Desarrollo full stack con PHP, HTML, CSS, JS, MySQL, Python y PostgreSQL.',
                    'Responsable del desarrollo web frontend y backend para clientes de distintos rubros.',
                ],
                'en' => [
                    'Full stack development using PHP, HTML, CSS, JS, MySQL, Python, and PostgreSQL.',
                    'Responsible for frontend and backend web development for clients across industries.',
                ],
            ],
        ],
        [
            'position' => [ 'es' => 'Chief Technology Officer', 'en' => 'Chief Technology Officer' ],
            'company' => 'Psychopharmacology Institute',
            'period' => [ 'es' => 'May 2020 — Dic 2022', 'en' => 'May 2020 — Dec 2022' ],
            'details' => [
                'es' => [
                    'Gestión y desarrollo: estándares de código, seguridad e infraestructura; diseño y desarrollo de soluciones en equipo con metodologías ágiles (SCRUM).',
                    'Stack: backend Python/Django y frontend React; monolito en AWS Elastic Beanstalk, React en S3 con CloudFront y datos en MySQL RDS.',
                    'Lideré al equipo para reducir errores del 23% al 0,02% en picos de tráfico y elevar la seniority del equipo.',
                    'Migré procesos pesados a AWS Lambdas (incluido un servicio de transcripción de PDF) para reducir la carga del core.',
                    'Solución de búsqueda con Elastic Search e integración de un servicio de podcasts como nuevo producto para los clientes.',
                ],
                'en' => [
                    'Management and development: code standards, security, and infrastructure; designed and developed solutions within a team using agile methodologies (SCRUM).',
                    'Stack: Python/Django backend and React frontend; a monolithic backend on AWS Elastic Beanstalk, React in S3 with CloudFront, and data in a MySQL RDS.',
                    'Led the team to reduce errors from 23% to 0.02% during traffic peaks and raised the team seniority.',
                    'Moved heavy processes to AWS Lambdas (including a PDF transcription service) to reduce load on the core.',
                    'Built a search solution with Elastic Search and integrated a podcast service as a new product for the clients.',
                ],
            ],
        ],
        [
            'position' => [ 'es' => 'Backend Developer', 'en' => 'Backend Developer' ],
            'company' => 'Intive · Nubi Wallet',
            'period' => [ 'es' => 'Ago 2018 — May 2020', 'en' => 'Aug 2018 — May 2020' ],
            'details' => [
                'es' => [
                    'Backend de la app Nubi Wallet (proyectada para 4M de usuarios) con microservicios Python/Flask desplegados en AWS.',
                    'Diseño y mantenimiento de ~30 microservicios con RabbitMQ como broker, noSQL para lectura y SQL para escritura.',
                    'Módulo interno pip-installable para funcionalidad compartida entre microservicios, mejorando modularidad y reduciendo complejidad.',
                    'Refactor del módulo de comunicación con el broker: solución multi-thread para comunicación asíncrona y testing automatizado.',
                    'Participación en decisiones de arquitectura (uso de noSQL para escalabilidad) y Docker-compose para el desarrollo local.',
                ],
                'en' => [
                    'Developed the backend for the Nubi Wallet App (expected to support 4M users) using Python/Flask microservices deployed on AWS.',
                    'Designed and maintained ~30 microservices with RabbitMQ as a broker, noSQL for read/response, and SQL for writing.',
                    'Created an internal pip-installable module for shared functionality across microservices, improving modularity and reducing complexity.',
                    'Refactored the broker communication module: a multi-threaded solution for asynchronous communication and automated testing.',
                    'Participated in architecture decisions (proposing noSQL for scalability) and used Docker-compose for local development.',
                ],
            ],
        ],
        [
            'position' => [ 'es' => 'Backend Developer', 'en' => 'Backend Developer' ],
            'company' => 'Intive · Distll',
            'period' => [ 'es' => 'Mar 2018 — Jul 2018', 'en' => 'Mar 2018 — Jul 2018' ],
            'details' => [
                'es' => [
                    'Desarrollo rápido de apps móviles para clientes usando sus redes sociales como fuente de datos.',
                    'Backend Python/Flask integrado con una base de datos PostgreSQL.',
                    'Web scrapers asíncronos para recolectar y normalizar datos de múltiples redes sociales.',
                    'Mantenimiento y optimización de una API REST que entrega datos normalizados a una app móvil.',
                ],
                'en' => [
                    'Quickly developed mobile apps for clients using their social networks as data sources.',
                    'Contributed to a Python/Flask backend integrated with a PostgreSQL database.',
                    'Enhanced asynchronous web scrapers for collecting and normalizing data from multiple social networks.',
                    'Maintained and optimized a RESTful API for delivering normalized data to a mobile application.',
                ],
            ],
        ],
        [
            'position' => [ 'es' => 'Fullstack Developer', 'en' => 'Fullstack Developer' ],
            'company' => 'Baytree',
            'period' => [ 'es' => 'Ago 2015 — Mar 2018', 'en' => 'Aug 2015 — Mar 2018' ],
            'details' => [
                'es' => [
                    'Desarrollo full stack y gestión de proyectos.',
                    'Stack: full stack PHP/MySQL/HTML/CSS/JS y backend Python/Django/PostgreSQL.',
                ],
                'en' => [
                    'Full stack development and project management.',
                    'Stack: fullstack PHP/MySQL/HTML/CSS/JS and backend Python/Django/PostgreSQL.',
                ],
            ],
        ],
        [
            'position' => [ 'es' => 'Fullstack Developer', 'en' => 'Fullstack Developer' ],
            'company' => 'DFCL Studio',
            'period' => [ 'es' => 'Ene 2011 — Ago 2015', 'en' => 'Jan 2011 — Aug 2015' ],
            'details' => [
                'es' => [
                    'Desarrollo full stack con PHP/MySQL/HTML/CSS/JS.',
                    'Gestión de proyectos.',
                ],
                'en' => [
                    'Fullstack development using PHP/MySQL/HTML/CSS/JS.',
                    'Project management.',
                ],
            ],
        ],
        [
            'position' => [ 'es' => 'Developer', 'en' => 'Developer' ],
            'company' => 'Arsmedia',
            'period' => [ 'es' => 'Feb 2003 — Mar 2004', 'en' => 'Feb 2003 — Mar 2004' ],
            'details' => [
                'es' => [
                    'Desarrollo web frontend y backend: OOP, PHP, MySQL, JavaScript y APIs REST.',
                    'Diseño de sitios web.',
                ],
                'en' => [
                    'Frontend and backend web development: OOP, PHP, MySQL, JavaScript, and REST APIs.',
                    'Web site design.',
                ],
            ],
        ],
    ];
}

function es_educacion() {
    return [
        [
            'title' => [ 'es' => 'Técnico en Comunicación Multimedial · Diseño Multimedia', 'en' => 'Multimedia Communication Technician · Multimedia Design' ],
            'place' => 'Escuela Da Vinci',
            'period' => '2005 — 2010',
        ],
        [
            'title' => [ 'es' => 'Ingeniería en Sistemas', 'en' => 'Systems Engineering' ],
            'place' => 'Universidad Tecnológica Nacional',
            'period' => '2000 — 2002',
        ],
    ];
}

function es_certificaciones() {
    return [
        [
            'title'  => 'Claude Certified Architect — Foundations',
            'issuer'  => 'Anthropic',
            'period' => [ 'es' => 'Ago 2026', 'en' => 'Aug 2026' ],
            'link'  => 'https://www.credly.com/badges/62d12055-cbcf-4935-a2ed-d4817c438a02',
        ],
    ];
}

function es_habilidades() {
    return [ 'Python', 'FastAPI', 'Django', 'Flask', 'PostgreSQL', 'MySQL', 'MongoDB', 'Redis', 'Celery', 'RabbitMQ', 'Docker', 'AWS', 'Claude', 'LangChain', 'Git', 'React', 'Vue', 'PHP', 'Laravel', 'WordPress', 'JavaScript' ];
}

/** Items del ticker animado del header del home (subset elegido a mano, igual que el original). */
function es_habilidades_ticker() {
    return [ 'Python', 'FastAPI', 'Django', 'PostgreSQL', 'AWS', 'Claude', 'LangChain', 'Docker', 'Celery', 'RabbitMQ', 'React', 'Git', 'PHP' ];
}
