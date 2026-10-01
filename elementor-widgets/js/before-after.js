/**
 * Widget Before / After : l'image "après" est révélée selon la position du pointeur
 * (souris, doigt ou stylet) ou au clavier (flèches, Début, Fin).
 */
(function () {
    'use strict';

    var KEY_STEP = 5;

    function initSlider(slider) {
        if (!slider || slider.dataset.baReady) {
            return;
        }

        var after = slider.querySelector('.ba-after');

        if (!after) {
            return;
        }

        var initial = parseFloat(slider.dataset.initial);
        var resetOnLeave = slider.dataset.reset !== 'no';
        var current;

        if (isNaN(initial)) {
            initial = 50;
        }

        function apply(pct) {
            current = Math.max(0, Math.min(100, pct));
            after.style.clipPath = 'inset(0 ' + (100 - current) + '% 0 0)';
            slider.style.setProperty('--ba-position', current + '%');
            slider.setAttribute('aria-valuenow', Math.round(current));
        }

        function fromEvent(e) {
            var rect = slider.getBoundingClientRect();
            apply(((e.clientX - rect.left) / rect.width) * 100);
        }

        apply(initial);
        slider.dataset.baReady = '1';

        slider.addEventListener('pointermove', fromEvent);
        slider.addEventListener('pointerdown', fromEvent);

        slider.addEventListener('pointerleave', function (e) {
            if (resetOnLeave && e.pointerType === 'mouse') {
                apply(initial);
            }
        });

        slider.addEventListener('keydown', function (e) {
            var keys = {
                ArrowLeft: current - KEY_STEP,
                ArrowDown: current - KEY_STEP,
                ArrowRight: current + KEY_STEP,
                ArrowUp: current + KEY_STEP,
                Home: 0,
                End: 100,
            };

            if (e.key in keys) {
                e.preventDefault();
                apply(keys[e.key]);
            }
        });
    }

    function initAll(scope) {
        (scope || document).querySelectorAll('.ba-slider').forEach(initSlider);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            initAll();
        });
    } else {
        initAll();
    }

    window.addEventListener('elementor/frontend/init', function () {
        window.elementorFrontend.hooks.addAction('frontend/element_ready/ba_before_after.default', function ($scope) {
            initAll($scope[0]);
        });
    });
})();
