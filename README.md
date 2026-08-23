# Tema WordPress — Eduardo Seelig

Tema a medida WordPress clásico (PHP + Tailwind compilado), para el sitio www.eduardoseelig.com

## Probar local con Docker (recomendado)
Levanta MySQL + WordPress con el tema ya instalado, activado y las páginas
`cv` y `cursos` creadas automáticamente.

```bash
docker compose up -d db wordpress   # levanta la base y WordPress
docker compose run --rm wpcli       # instala WP, activa el tema y crea las páginas
```

- Sitio: http://localhost:8080
- Admin: http://localhost:8080/wp-admin — usuario `admin`, contraseña `admin`

Este repo se monta dentro del contenedor como `wp-content/themes/eduardo-seelig`,
así que cualquier cambio en los `.php` se ve al recargar. Si tocás clases de
Tailwind, recompilá el CSS (ver "Editar estilos").

Para personalizar puertos/credenciales: `cp .env.example .env` y editá.

Comandos útiles:
```bash
docker compose logs -f wordpress    # ver logs
docker compose down                 # apagar (conserva datos)
docker compose down -v              # apagar y borrar la base (empezar de cero)
```

## Instalación (sin Docker)
1. Instalá WordPress (local con LocalWP, o en tu hosting).
2. Copiá esta carpeta completa a `wp-content/themes/eduardo-seelig`.
3. Activá el tema desde Apariencia > Temas.
4. Creá 2 páginas en WordPress:
   - Una con slug **cv** → asignale la plantilla "CV" (Atributos de página).
   - Una con slug **cursos** → asignale la plantilla "Cursos".
5. En Ajustes > Lectura, dejá "Tu página de inicio muestra: una página estática"
   NO hace falta: el tema usa `front-page.php` automáticamente para el home.

## Editar contenido
Todo el contenido (perfil, proyectos, experiencia, cursos, habilidades) vive en:
- `inc/site-content.php` — datos (equivalente a data/site.js del sitio original)
- `inc/ui-strings.php` — textos de botones, navegación, títulos de sección

No hace falta tocar los archivos .php de las páginas para cambiar texto.

## Editar estilos
Los estilos son Tailwind CSS compilado a `assets/css/app.css`. Si cambiás
clases de Tailwind en los .php, hay que recompilar:

```bash
npm install
npm run build       # compila una vez
npm run watch        # recompila automáticamente mientras editás
```

## Estructura
- `front-page.php` — Home
- `page-cv.php` — plantilla de CV
- `page-cursos.php` — plantilla de Cursos (con filtro por formato)
- `header.php` / `footer.php` — header y footer compartidos
- `assets/js/main.js` — toggle de idioma ES/EN, menú móvil, animaciones
  reveal-on-scroll, contador animado, filtro de cursos (reemplaza
  React + framer-motion del sitio original, sin dependencias)
- `inc/i18n.php` — sistema bilingüe ES/EN (sin plugin, sin recarga de página)
