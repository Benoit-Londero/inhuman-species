import inView from "in-view";
import Swiper from "swiper";

// Initialise Swiper
const swiper = new Swiper('.swiper-portfolio', {
  // Swiper options
  pagination: {
    el: '.swiper-pagination',
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});

$(document).ready(function () {
  //IN-VIEW
  const elements = [".from-left", ".from-right", ".from-top", ".from-bottom"];
  elements.forEach(selector => {
    document.querySelectorAll(selector).forEach(el => {
      el.classList.add("invisible");
    });
  });

  function makeMagic(data, direction) {
    data.classList.remove("invisible");
    data.classList.add(direction);
  }

  function removeMagic(data, direction) {
    data.classList.add("invisible");
    data.classList.remove(direction);
  }

  inView.offset(150);

  inView(".from-left")
    .on("enter", (el) => {
      makeMagic(el, "fade-in-left");
    })
    .on("exit", (el) => {
      removeMagic(el, "fade-in-left");
    });

  inView(".from-right")
    .on("enter", (el) => {
      makeMagic(el, "fade-in-right");
    })
    .on("exit", (el) => {
      removeMagic(el, "fade-in-right");
    });

  inView(".from-bottom")
    .on("enter", (el) => {
      makeMagic(el, "fade-in-bottom");
    })
    .on("exit", (el) => {
      removeMagic(el, "fade-in-bottom");
    });

  inView(".from-top")
    .on("enter", (el) => {
      makeMagic(el, "fade-in-top");
    })
    .on("exit", (el) => {
      removeMagic(el, "fade-in-top");
    });

  // Add event listeners for Swiper
  swiper.on('slideChange', () => {
    elements.forEach(selector => {
      document.querySelectorAll(selector).forEach(el => {
        el.classList.add("invisible");
      });
    });
  });

  swiper.on('transitionEnd', () => {
    inView.check(); // Re-check visibility of elements when slide transition ends
  });
});
