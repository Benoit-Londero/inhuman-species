
const swiper = new Swiper( '.swiper-portfolio', {
    speed: 800,
    //autoplay: true,
    loop: true,
    parallax: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    
    grabCursor: true,
    // effect: "creative",
    // creativeEffect: {
    //     prev: {
    //       shadow: true,
    //       translate: ["-20%",0 , , -1],
    //     },
    //     next: {
    //       translate: [ "100%",0, 0],
    //     },
    // },
});