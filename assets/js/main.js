(function () {
    'use strict';

    var STORAGE_KEY = 'es-lang';
    var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ---------- Íconos (lucide) ---------- */
    function renderIcons() {
        if (window.lucide && typeof window.lucide.createIcons === 'function') {
            window.lucide.createIcons();
        }
    }

    /* ---------- Idioma ES/EN ---------- */
    function getLang() {
        try {
            var saved = localStorage.getItem(STORAGE_KEY);
            if (saved === 'es' || saved === 'en') return saved;
        } catch (e) {}
        return 'es';
    }

    function applyLang(lang) {
        document.documentElement.lang = lang;

        document.querySelectorAll('.i18n').forEach(function (el) {
            if (el.getAttribute('data-lang') === lang) {
                el.removeAttribute('hidden');
            } else {
                el.setAttribute('hidden', '');
            }
        });

        document.querySelectorAll('.es-lang-btn').forEach(function (btn) {
            var active = btn.getAttribute('data-set-lang') === lang;
            btn.classList.toggle('bg-[hsl(var(--ink))]', active);
            btn.classList.toggle('text-primary-foreground', active);
            btn.classList.toggle('text-muted-foreground', !active);
            btn.setAttribute('aria-pressed', active ? 'true' : 'false');
        });

        // Filtros de la página de Cursos usan el label en español como llave
        // interna; si el usuario cambia a EN mientras un filtro no-"todos"
        // está activo, lo dejamos activo (el texto visible ya cambia solo).
    }

    function setLang(lang) {
        try { localStorage.setItem(STORAGE_KEY, lang); } catch (e) {}
        applyLang(lang);
    }

    function initLangToggle() {
        document.querySelectorAll('.es-lang-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                setLang(btn.getAttribute('data-set-lang'));
            });
        });
        applyLang(getLang());
    }

    /* ---------- Menú móvil ---------- */
    function initMobileMenu() {
        var btn = document.getElementById('es-menu-btn');
        var menu = document.getElementById('es-mobile-menu');
        var iconOpen = document.getElementById('es-menu-icon-open');
        var iconClose = document.getElementById('es-menu-icon-close');
        if (!btn || !menu) return;

        btn.addEventListener('click', function () {
            var isOpen = !menu.classList.contains('hidden');
            menu.classList.toggle('hidden', isOpen);
            if (iconOpen && iconClose) {
                iconOpen.classList.toggle('hidden', !isOpen);
                iconClose.classList.toggle('hidden', isOpen);
            }
        });

        menu.querySelectorAll('a').forEach(function (a) {
            a.addEventListener('click', function () {
                menu.classList.add('hidden');
                if (iconOpen && iconClose) {
                    iconOpen.classList.remove('hidden');
                    iconClose.classList.add('hidden');
                }
            });
        });
    }

    /* ---------- Reveal on scroll ---------- */
    function initReveal() {
        var items = document.querySelectorAll('.es-reveal');
        if (!items.length) return;

        if (prefersReduced || !('IntersectionObserver' in window)) {
            items.forEach(function (el) { el.classList.add('is-visible'); });
            return;
        }

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '-60px 0px' });

        items.forEach(function (el) { observer.observe(el); });
    }

    /* ---------- Contador animado ---------- */
    function easeOutCubic(p) { return 1 - Math.pow(1 - p, 3); }

    function initCountUp() {
        var items = document.querySelectorAll('.es-countup');
        if (!items.length) return;

        items.forEach(function (el) {
            var target = Number(el.getAttribute('data-value')) || 0;
            var duration = Number(el.getAttribute('data-duration')) || 1600;

            if (prefersReduced || !('IntersectionObserver' in window)) {
                el.textContent = String(target);
                return;
            }

            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;
                    observer.disconnect();
                    var start = performance.now();
                    function tick(now) {
                        var progress = Math.min((now - start) / duration, 1);
                        el.textContent = String(Math.round(target * easeOutCubic(progress)));
                        if (progress < 1) requestAnimationFrame(tick);
                    }
                    requestAnimationFrame(tick);
                });
            }, { threshold: 0.3 });

            observer.observe(el);
        });
    }

    /* ---------- Filtro de Cursos ---------- */
    function initCursosFiltro() {
        var wrap = document.getElementById('es-cursos-filtros');
        var grid = document.getElementById('es-cursos-grid');
        var vacio = document.getElementById('es-cursos-vacio');
        if (!wrap || !grid) return;

        var buttons = wrap.querySelectorAll('.es-filtro-btn');
        var cards = grid.querySelectorAll('.es-curso-card');

        function setActive(btn) {
            buttons.forEach(function (b) {
                var active = b === btn;
                b.classList.toggle('border-[hsl(var(--accent))]', active);
                b.classList.toggle('bg-[hsl(var(--accent))]', active);
                b.classList.toggle('text-accent-foreground', active);
                b.classList.toggle('border-border', !active);
                b.classList.toggle('text-muted-foreground', !active);
            });
        }

        function applyFilter(formatoEs) {
            var visibleCount = 0;
            cards.forEach(function (card) {
                var match = !formatoEs || card.getAttribute('data-formato-es') === formatoEs;
                card.style.display = match ? '' : 'none';
                if (match) visibleCount++;
            });
            if (vacio) vacio.classList.toggle('hidden', visibleCount !== 0);
        }

        buttons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                setActive(btn);
                applyFilter(btn.getAttribute('data-filtro-es') || null);
            });
        });

        // Estado inicial: "Todos" activo
        if (buttons.length) setActive(buttons[0]);
    }

    /* ---------- Init ---------- */
    document.addEventListener('DOMContentLoaded', function () {
        document.body.classList.remove('js-pending');
        renderIcons();
        initLangToggle();
        initMobileMenu();
        initReveal();
        initCountUp();
        initCursosFiltro();
    });
})();
