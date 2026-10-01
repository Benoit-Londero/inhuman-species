/* global Swiper */
/**
 * Initialisation des sliders du thème (widgets Elementor + templates PHP).
 *
 * Chaque slider est initialisé indépendamment : plusieurs sliders peuvent cohabiter
 * sur une même page, et les widgets sont ré-initialisés dans l'éditeur Elementor.
 */
(function () {
    'use strict';

    var DEFAULTS = {
        '.swiper-portfolio': {
            speed: 800,
            loop: true,
            parallax: true,
            grabCursor: true,
        },
        '.swiper-project': {
            speed: 800,
            slidesPerView: 3.5,
            direction: 'vertical',
            loop: true,
            parallax: true,
            grabCursor: true,
        },
    };

    function readOptions(el) {
        try {
            return JSON.parse(el.dataset.swiperOptions || '{}') || {};
        } catch (e) {
            return {};
        }
    }

    /**
     * Les slides clonées par le mode "loop" n'ont pas les écouteurs fslightbox :
     * on les retire de la galerie et on redirige leur clic vers la slide d'origine.
     */
    function bindLightboxClones(el) {
        var clones = el.querySelectorAll('.swiper-slide-duplicate a[data-fslightbox]');

        clones.forEach(function (link) {
            var slide = link.closest('.swiper-slide');
            var index = slide ? slide.dataset.swiperSlideIndex : null;

            link.removeAttribute('data-fslightbox');
            link.onclick = function (e) {
                var original = el.querySelector(
                    '.swiper-slide:not(.swiper-slide-duplicate)[data-swiper-slide-index="' + index + '"] a[data-fslightbox]'
                );

                if (original) {
                    e.preventDefault();
                    original.click();
                }
            };
        });

        if (typeof window.refreshFsLightbox === 'function') {
            window.refreshFsLightbox();
        }
    }

    function initSlider(el, selector) {
        if (!el || el.swiper || typeof Swiper === 'undefined') {
            return;
        }

        var options = Object.assign({}, DEFAULTS[selector], readOptions(el));
        var autoplayDelay = parseInt(options.autoplay, 10);

        if (autoplayDelay > 0) {
            options.autoplay = { delay: autoplayDelay, disableOnInteraction: false, pauseOnMouseEnter: true };
        } else {
            delete options.autoplay;
        }

        var pagination = el.querySelector('.swiper-pagination');
        var next = el.querySelector('.swiper-button-next');
        var prev = el.querySelector('.swiper-button-prev');

        options.pagination = pagination ? { el: pagination, clickable: true } : false;
        options.navigation = next && prev ? { nextEl: next, prevEl: prev } : false;

        new Swiper(el, options);

        if (el.querySelector('a[data-fslightbox]')) {
            bindLightboxClones(el);
        }
    }

    function initAll(scope) {
        var root = scope || document;

        Object.keys(DEFAULTS).forEach(function (selector) {
            root.querySelectorAll(selector).forEach(function (el) {
                initSlider(el, selector);
            });
        });
    }

    // Templates PHP (hors Elementor) et front classique.
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            initAll();
        });
    } else {
        initAll();
    }

    // Widgets Elementor : (ré)initialisation à chaque rendu, y compris dans l'éditeur.
    window.addEventListener('elementor/frontend/init', function () {
        ['swiper_fullscreen', 'swiper_projet'].forEach(function (widget) {
            window.elementorFrontend.hooks.addAction('frontend/element_ready/' + widget + '.default', function ($scope) {
                initAll($scope[0]);
            });
        });
    });
})();
