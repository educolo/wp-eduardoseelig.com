<?php
/**
 * Strings de interfaz (navegación, botones, encabezados de sección).
 * Equivalente a i18n/translations.js del sitio original.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function es_ui() {
    return [
        'es' => [
            'nav' => [
                'enfoque' => 'Enfoque', 'trabajo' => 'Trabajo', 'blog' => 'Blog', 'cv' => 'CV', 'contacto' => 'Contacto',
            ],
            'hero' => [
                'tag' => 'Argentina · Remoto',
                'linea1' => 'Ayudo a construir', 'linea2' => 'desde el software', 'linea3' => 'el producto correcto.',
                'ctaContacto' => 'Hablemos', 'ctaTrabajo' => 'Ver trabajo', 'cvLink' => 'Ver CV',
            ],
            'metricas' => [
                'anios' => 'años construyendo producto', 'proyectos' => 'proyectos y productos',
                'roles' => 'roles técnicos (dev · CTO)', 'paises' => 'países de colaboración',
            ],
            'secciones' => [
                'enfoque' => '01 · Enfoque', 'enfoqueTitulo' => 'Construir producto, no solo software',
                'trabajo' => '02 · Trabajo', 'trabajoTitulo' => 'Proyectos seleccionados',
                'trayectoria' => '03 · Trayectoria', 'trayectoriaTitulo' => 'Dos décadas en la trinchera',
                'blog' => '04 · Blog', 'blogTitulo' => 'Notas sobre ingeniería, producto e IA',
                'contacto' => '05 · Contacto', 'contactoTitulo' => '¿Construyamos algo? Escríbeme y conversamos.',
                'contactoTexto' => 'Punto de contacto profesional: cuéntame tu idea, tu producto o tu equipo y vemos juntos cómo aportar. Sin planes predefinidos ni paquetes: cada conversación empieza desde cero.',
            ],
            'cv' => [
                'actualizado' => 'Curriculum vitae · actualizado 2026', 'descargar' => 'Descargar PDF',
                'perfil' => 'Perfil', 'experiencia' => 'Experiencia profesional',
                'formacion' => 'Formación y certificaciones', 'stack' => 'Stack y herramientas', 'enfoque' => 'Enfoque de trabajo',
            ],
            'blogPage' => [
                'tag' => 'Blog', 'titulo' => 'Notas, guías y apuntes',
                'sub' => 'Comparto lo que voy aprendiendo construyendo producto: ingeniería de software, IA y producto. Sin relleno.',
                'leer' => 'Leer', 'volver' => 'Volver al blog', 'vacio' => 'Todavía no hay entradas publicadas. Pronto.',
            ],
            'footer' => [ 'contacto' => 'Contacto', 'redes' => 'Redes', 'secciones' => 'Secciones' ],
            'misc' => [ 'verMas' => 'Ver más', 'verTodos' => 'Ver todos' ],
            // Anclas (id) de las secciones de la home.
            'anclas' => [ 'enfoque' => 'enfoque', 'trabajo' => 'trabajo', 'contacto' => 'contacto' ],
        ],
        'en' => [
            'nav' => [
                'enfoque' => 'Focus', 'trabajo' => 'Work', 'blog' => 'Blog', 'cv' => 'CV', 'contacto' => 'Contact',
            ],
            'hero' => [
                'tag' => 'Argentina · Remote',
                'linea1' => 'I help build', 'linea2' => 'from the software', 'linea3' => 'the right product.',
                'ctaContacto' => "Let's talk", 'ctaTrabajo' => 'See work', 'cvLink' => 'View CV',
            ],
            'metricas' => [
                'anios' => 'years building product', 'proyectos' => 'projects & products',
                'roles' => 'technical roles (dev · CTO)', 'paises' => 'countries collaborated with',
            ],
            'secciones' => [
                'enfoque' => '01 · Focus', 'enfoqueTitulo' => 'Building product, not just software',
                'trabajo' => '02 · Work', 'trabajoTitulo' => 'Selected projects',
                'trayectoria' => '03 · Journey', 'trayectoriaTitulo' => 'Two decades in the trenches',
                'blog' => '04 · Blog', 'blogTitulo' => 'Notes on engineering, product & AI',
                'contacto' => '05 · Contact', 'contactoTitulo' => "Let's build something? Write to me and let's talk.",
                'contactoTexto' => "Professional point of contact: tell me about your idea, product or team and let's see how I can help. No predefined plans or packages: every conversation starts from scratch.",
            ],
            'cv' => [
                'actualizado' => 'Curriculum vitae · updated 2026', 'descargar' => 'Download PDF',
                'perfil' => 'Profile', 'experiencia' => 'Professional experience',
                'formacion' => 'Education & certifications', 'stack' => 'Stack & tools', 'enfoque' => 'Approach to work',
            ],
            'blogPage' => [
                'tag' => 'Blog', 'titulo' => 'Notes, guides & write-ups',
                'sub' => 'I share what I learn building product: software engineering, AI and product. No filler.',
                'leer' => 'Read', 'volver' => 'Back to blog', 'vacio' => 'No posts published yet. Coming soon.',
            ],
            'footer' => [ 'contacto' => 'Contact', 'redes' => 'Social', 'secciones' => 'Sections' ],
            'misc' => [ 'verMas' => 'See more', 'verTodos' => 'See all' ],
            'anclas' => [ 'enfoque' => 'focus', 'trabajo' => 'work', 'contacto' => 'contact' ],
        ],
    ];
}
