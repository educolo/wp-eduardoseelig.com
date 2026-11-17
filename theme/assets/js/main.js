(function () {
    'use strict';

    var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ---------- Íconos (lucide) ---------- */
    function renderIcons() {
        if (window.lucide && typeof window.lucide.createIcons === 'function') {
            window.lucide.createIcons();
        }
    }

    /* ---------- Confirmación al cambiar a un idioma sin traducción ---------- */
    // Los links del selector que llevan a un idioma donde la página actual no
    // existe traen data-es-confirm* (textos en el idioma de destino). En vez de
    // navegar directo, se muestra un toast para confirmar. Si el JS no corre,
    // el link funciona igual y la página de destino muestra un aviso.
    function initLangConfirm() {
        var toast = document.getElementById('es-lang-confirm');
        if (!toast) return;
        var msg = toast.querySelector('#es-lang-confirm-msg');
        var ok = toast.querySelector('[data-es-confirm-ok]');
        var cancel = toast.querySelector('[data-es-confirm-cancel]');
        var opener = null;

        function close() {
            toast.hidden = true;
            if (opener) opener.focus();
            opener = null;
        }

        function open(link) {
            opener = link;
            // Ya confirmó: el aviso de la página de destino sobra.
            var url = new URL(link.href, window.location.href);
            url.searchParams.delete('untranslated');

            toast.setAttribute('lang', link.getAttribute('lang') || '');
            msg.textContent = link.getAttribute('data-es-confirm');
            ok.textContent = link.getAttribute('data-es-confirm-ok');
            ok.href = url.toString();
            cancel.textContent = link.getAttribute('data-es-confirm-cancel');
            toast.hidden = false;
            ok.focus();
        }

        document.querySelectorAll('a[data-es-confirm]').forEach(function (link) {
            link.addEventListener('click', function (e) {
                if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey || e.button !== 0) return; // nueva pestaña, etc.
                e.preventDefault();
                open(link);
            });
        });

        cancel.addEventListener('click', close);
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !toast.hidden) close();
        });
        document.addEventListener('click', function (e) {
            if (toast.hidden || toast.contains(e.target) || (opener && opener.contains(e.target))) return;
            close();
        });
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

    /* ---------- Init ---------- */
    document.addEventListener('DOMContentLoaded', function () {
        document.body.classList.remove('js-pending');
        renderIcons();
        initLangConfirm();
        initMobileMenu();
        initReveal();
        initCountUp();
    });
})();
