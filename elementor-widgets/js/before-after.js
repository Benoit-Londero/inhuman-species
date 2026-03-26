document.addEventListener("DOMContentLoaded", function () {
  const sliders = document.querySelectorAll(".ba-slider");

  sliders.forEach((slider) => {
    const after = slider.querySelector(".ba-after");
    const initial = parseFloat(slider.dataset.initial) || 50;

    function applyClip(pct) {
      pct = Math.max(0, Math.min(100, pct));
      after.style.clipPath = `inset(0 ${100 - pct}% 0 0)`;
    }

    // Start position
    applyClip(initial);

    slider.addEventListener("mousemove", function (e) {
      const rect = slider.getBoundingClientRect();
      const pct = ((e.clientX - rect.left) / rect.width) * 100;
      applyClip(pct);
    });

    slider.addEventListener("mouseleave", function () {
      applyClip(initial);
    });
  });
});
