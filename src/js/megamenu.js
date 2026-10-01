document.addEventListener('DOMContentLoaded', () => {
    const menu    = document.getElementById('megamenu');
    const toggle  = document.querySelector('.menu-toggle');
    const closers = document.querySelectorAll('.menu-close');

    if (!menu || !toggle) return;

    const setOpen = (open) => {
        menu.classList.toggle('open', open);
        menu.setAttribute('aria-hidden', String(!open));
        toggle.setAttribute('aria-expanded', String(open));
        document.body.classList.toggle('megamenu-open', open);

        if (open) {
            menu.querySelector('a, button')?.focus();
        } else {
            toggle.focus();
        }
    };

    toggle.addEventListener('click', () => setOpen(!menu.classList.contains('open')));
    closers.forEach((btn) => btn.addEventListener('click', () => setOpen(false)));

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && menu.classList.contains('open')) {
            setOpen(false);
        }
    });
});
