document.addEventListener('DOMContentLoaded', () => {
    const trigger = document.querySelector('.open-menu');
    const menu    = document.querySelector('.menu-megamenu');

    if (!trigger || !menu) return;

    trigger.addEventListener('click', () => {
        menu.classList.toggle('open');
    });
});
