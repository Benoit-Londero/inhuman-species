const ANIM_MAP = {
    'from-left':   'fade-in-left',
    'from-right':  'fade-in-right',
    'from-top':    'fade-in-top',
    'from-bottom': 'fade-in-bottom',
};

document.addEventListener('DOMContentLoaded', () => {

    // ── Scroll animations via IntersectionObserver ──────────────────────────
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                const el        = entry.target;
                const animClass = el.dataset.animClass;

                if (entry.isIntersecting) {
                    el.classList.remove('invisible');
                    el.classList.add(animClass);
                } else {
                    el.classList.add('invisible');
                    el.classList.remove(animClass);
                }
            });
        },
        { rootMargin: '0px 0px -150px 0px' }
    );

    Object.entries(ANIM_MAP).forEach(([selector, animClass]) => {
        document.querySelectorAll('.' + selector).forEach((el) => {
            el.dataset.animClass = animClass;
            el.classList.add('invisible');
            observer.observe(el);
        });
    });

    // ── Front-page before/after hover ───────────────────────────────────────
    const mainContent = document.getElementById('main-content');
    const imageAfter  = mainContent?.querySelector('.image-after');

    if (mainContent && imageAfter) {
        mainContent.addEventListener('mousemove', (e) => {
            const rect       = mainContent.getBoundingClientRect();
            const percentage = ((e.clientX - rect.left) / rect.width) * 100;
            imageAfter.style.clipPath = `inset(0 ${100 - percentage}% 0 0)`;
        });
    }
});
