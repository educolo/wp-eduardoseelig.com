# Tema WordPress — Eduardo Seelig

Tema a medida WordPress clásico (PHP + Tailwind compilado), para el sitio www.eduardoseelig.com

El tema en sí está en `theme/`; el resto del repo (Docker, scripts, build de
Tailwind, docs) es para desarrollo y no llega al hosting (ver "Deploy").

## Probar local con Docker (recomendado)
Levanta MySQL + WordPress con el tema ya instalado, activado y las páginas
`cv` y `cursos` creadas automáticamente.

```bash
docker compose up -d db wordpress   # levanta la base y WordPress
docker compose run --rm wpcli       # instala WP, activa el tema y crea las páginas
```

- Sitio: http://localhost:8080
- Admin: http://localhost:8080/wp-admin — usuario `admin`, contraseña `admin`

La carpeta `theme/` se monta dentro del contenedor como `wp-content/themes/eduardo-seelig`,
así que cualquier cambio en los `.php` se ve al recargar. Si tocás clases de
Tailwind, recompilá el CSS (ver "Editar estilos").

Para personalizar puertos/credenciales: `cp .env.example .env` y editá.

> **Si ya tenías el entorno levantado de antes:** los archivos de WordPress
> viven en el volumen `wp_core` y no se actualizan al cambiar la imagen en
> `docker-compose.yml` (por ejemplo, de 6.5 a 7.1). Para tomar la versión
> nueva, recreá todo una vez: `docker compose down -v` y volvé a correr los
> dos comandos de arriba (borra la base local).

Comandos útiles:
```bash
docker compose logs -f wordpress    # ver logs
docker compose down                 # apagar (conserva datos)
docker compose down -v              # apagar y borrar la base (empezar de cero)
```

## Instalación (sin Docker)
1. Instalá WordPress (local con LocalWP, o en tu hosting).
2. Copiá el contenido de `theme/` a `wp-content/themes/eduardo-seelig`.
3. Activá el tema desde Apariencia > Temas.
4. Creá 2 páginas en WordPress:
   - Una con slug **cv** → asignale la plantilla "CV" (Atributos de página).
   - Una con slug **cursos** → asignale la plantilla "Cursos".
5. En Ajustes > Lectura, dejá "Tu página de inicio muestra: una página estática"
   NO hace falta: el tema usa `front-page.php` automáticamente para el home.

## Idiomas (Polylang)
El sitio es bilingüe con el plugin gratuito [Polylang](https://wordpress.org/plugins/polylang/):

- Español en `/` (idioma por defecto, sin prefijo) e inglés en `/en/`.
- La primera visita a la home redirige al idioma del navegador (cookie `pll_language`).
- **Notas del blog**: cada idioma es un post propio. Para traducir una nota,
  en la caja *Idiomas* del editor tocá el “+” junto al otro idioma. Una nota
  puede existir en un solo idioma; el listado de cada idioma muestra solo las suyas.
  Si desde una nota sin traducción se cambia de idioma, el selector lleva al
  blog del otro idioma con un aviso (`?untranslated=1`, textos en `notices`
  de `theme/inc/ui-strings.php`).
- **Páginas `cv` y `blog`**: tienen su traducción en inglés (`/en/resume/` y
  `/en/posts/` en local), con la misma plantilla.
- **Textos fijos del tema** (home, CV, botones): siguen en `theme/inc/site-content.php`
  e `theme/inc/ui-strings.php` como `['es' => ..., 'en' => ...]`.

Con Docker, `docker compose run --rm wpcli` instala y configura todo esto solo.

### Configuración en producción (una sola vez)
**Por SSH (recomendado):** `scripts/prod-setup-polylang.sh` hace todo lo de
abajo con WP-CLI (backup de la base, Polylang, idiomas, páginas EN y
vinculación de notas existentes) y es idempotente. Correrlo recién cuando
el tema >= 1.1.0 esté desplegado:

```bash
ssh -p <puerto> <usuario>@<host> 'bash -s' < scripts/prod-setup-polylang.sh
```

**Desde el admin**, a mano:
1. Plugins > Añadir nuevo > instalar y activar **Polylang**. Saltear el asistente.
2. Idiomas > Idiomas: agregar **Español** (`es`, es_AR), primero y por defecto,
   y **English** (`en`, en_US).
3. Asignar el idioma por defecto a todo el contenido existente (Polylang lo
   ofrece con un aviso arriba de la pantalla de idiomas).
4. Idiomas > Ajustes > URL modifications: “The language is set from the
   directory name”, **ocultar** el idioma por defecto en la URL y quitar
   `/language/`. En “Detect browser language”: **activado**.
5. Páginas: en `CV` y `Blog`, crear la traducción en inglés desde la columna
   del idioma (+), con la misma plantilla (CV / Blog) y slug propio
   (ej. `resume`, `posts`).
6. Posts con versión EN del sistema anterior: muestran la caja “Versión en
   inglés anterior”. Crear la traducción EN, copiar título y contenido, y
   marcar “borrar estos datos” al guardar.
7. Ajustes > Enlaces permanentes > Guardar (refresca las URLs).

## Analytics y cookies
Google Analytics 4 (`G-YMDVYXVKJ2`) se carga desde el tema, sin plugins
(`theme/inc/analytics.php`), con Consent Mode v2:

- En la UE/EEE, el Reino Unido y Suiza la analítica arranca **denegada** (lo
  decide Google por país) y en el resto del mundo, concedida.
- El banner (`template-parts/cookie-banner.php`) aparece solo a visitantes con
  zona horaria europea que todavía no eligieron. La decisión se guarda en
  `localStorage` (`es_consent`). El botón "Cookies" del footer lo vuelve a abrir.
  Al rechazar se borran las cookies `_ga` que ya existieran.
- GA no se carga fuera de `eduardoseelig.com` (local/staging) ni para usuarios
  logueados. Para probarlo en local: `add_filter( 'es_analytics_should_load', '__return_true' );`
- Mientras **Site Kit** esté activo, el tema solo imprime el consentimiento
  (que aplica a la etiqueta de Site Kit) y no carga GA, para no medir dos veces.
  Una vez desplegado, desinstalar Site Kit y el tema pasa a cargar GA solo.
- El link a la política de privacidad (banner y footer) sale de la página
  elegida en Ajustes > Privacidad (o su traducción de Polylang). Si no hay una
  publicada, no se muestra.

## Deploy
Al mergear a `main`, el workflow `.github/workflows/deploy.yml` compila el CSS
y publica **solo el contenido de `theme/`** en la rama `deploy`, con un commit
por merge que referencia el commit de origen. Hostinger despliega desde la rama
`deploy` (hPanel > Avanzado > Git) a `wp-content/themes/eduardo-seelig`.

- Para volver a una versión anterior: revertir el commit en `deploy`, o correr
  el workflow a mano (Actions > Deploy > Run workflow) sobre un commit de `main`.
- `theme/.htaccess` bloquea igual dotfiles y archivos de tooling (Hostinger
  deja `.git/` en la carpeta del tema).

## Editar contenido
Todo el contenido (perfil, proyectos, experiencia, cursos, habilidades) vive en:
- `theme/inc/site-content.php` — datos (equivalente a data/site.js del sitio original)
- `theme/inc/ui-strings.php` — textos de botones, navegación, títulos de sección

No hace falta tocar los archivos .php de las páginas para cambiar texto.

## Editar estilos
Los estilos son Tailwind CSS: `src/tailwind-input.css` se compila a
`theme/assets/css/app.css`. Si cambiás clases de Tailwind en los .php, hay que
recompilar para verlo en local (el deploy lo recompila igual, así que en
producción nunca queda un CSS desactualizado):

```bash
npm install
npm run build       # compila una vez
npm run watch        # recompila automáticamente mientras editás
# sin Node instalado:
docker run --rm -u "$(id -u):$(id -g)" -v "$PWD":/app -w /app node:20-alpine sh -c 'npm ci && npm run build'
```

## Estructura
```
theme/                    ← el tema (lo único que se despliega)
  front-page.php          Home
  page-cv.php             plantilla de CV
  page-blog.php, single.php   blog
  header.php / footer.php header y footer compartidos
  inc/i18n.php            helpers bilingües ES/EN sobre Polylang (idioma actual, URLs)
  inc/blog.php            blog bilingüe (Polylang) + caja de migración del sistema anterior
  inc/analytics.php       Google Analytics + Consent Mode, URL de la política de privacidad
  inc/site-content.php, inc/ui-strings.php   textos y datos
  template-parts/         selector de idioma, toast, avisos y banner de cookies
  assets/js/main.js       menú móvil, reveal-on-scroll, contador, toast de idioma, banner de cookies
  assets/css/app.css      CSS compilado
src/tailwind-input.css    fuente de Tailwind
docker/, docker-compose.yml   entorno local
scripts/                  scripts de producción (WP-CLI por SSH)
.github/workflows/        deploy a la rama `deploy`
```
