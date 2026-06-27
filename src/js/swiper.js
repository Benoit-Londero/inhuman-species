/* global Swiper */

document.addEventListener('DOMContentLoaded', () => {
    const portfolioEl = document.querySelector('.swiper-portfolio');
    const projectEl   = document.querySelector('.swiper-project');

    if (portfolioEl) {
        new Swiper('.swiper-portfolio', {
            speed:    800,
            loop:     true,
            parallax: true,
            grabCursor: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }

    if (projectEl) {
        new Swiper('.swiper-project', {
            speed:        800,
            slidesPerView: 3.5,
            direction:    'vertical',
            loop:         true,
            parallax:     true,
            grabCursor:   true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }
});
