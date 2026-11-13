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
2. Copiá esta carpeta completa a `wp-content/themes/eduardo-seelig`.
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
- **Páginas `cv` y `blog`**: tienen su traducción en inglés (`/en/resume/` y
  `/en/notes/` en local), con la misma plantilla.
- **Textos fijos del tema** (home, CV, botones): siguen en `inc/site-content.php`
  e `inc/ui-strings.php` como `['es' => ..., 'en' => ...]`.

Con Docker, `docker compose run --rm wpcli` instala y configura todo esto solo.

### Configuración en producción (una sola vez)
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
   (ej. `resume`, `notes`).
6. Posts con versión EN del sistema anterior: muestran la caja “Versión en
   inglés anterior”. Crear la traducción EN, copiar título y contenido, y
   marcar “borrar estos datos” al guardar.
7. Ajustes > Enlaces permanentes > Guardar (refresca las URLs).

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
- `assets/js/main.js` — menú móvil, animaciones reveal-on-scroll, contador
  animado (reemplaza React + framer-motion del sitio original, sin dependencias)
- `inc/i18n.php` — helpers bilingües ES/EN sobre Polylang (idioma actual, URLs)
- `inc/blog.php` — blog bilingüe (Polylang) + caja de migración del sistema anterior
