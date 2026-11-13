(function () {
    'use strict';

    var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ---------- Íconos (lucide) ---------- */
    function renderIcons() {
        if (window.lucide && typeof window.lucide.createIcons === 'function') {
            window.lucide.createIcons();
        }
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
        initMobileMenu();
        initReveal();
        initCountUp();
    });
})();
