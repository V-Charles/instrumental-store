/* =========================================================
   LOGIN / CADASTRO
========================================================= */

function togglePassword(id) {
    const input = document.getElementById(id);
    if (!input) return;
    input.type = input.type === "password" ? "text" : "password";
}

/* =========================================================
   HOME - HERO
========================================================= */

document.addEventListener("DOMContentLoaded", () => {
    const heroSlides = document.querySelectorAll(".home-hero-slide");
    const heroDots = document.querySelectorAll(".home-hero-dots span");
    const heroPrev = document.querySelector(".home-hero-prev");
    const heroNext = document.querySelector(".home-hero-next");

    let heroIndex = 0;

    function showHeroSlide(index) {
        if (!heroSlides.length) return;

        heroSlides.forEach(slide => slide.classList.remove("active"));
        heroDots.forEach(dot => dot.classList.remove("active"));

        heroSlides[index].classList.add("active");
        if (heroDots[index]) {
            heroDots[index].classList.add("active");
        }
    }

    if (heroPrev && heroNext && heroSlides.length) {
        heroPrev.addEventListener("click", () => {
            heroIndex = (heroIndex - 1 + heroSlides.length) % heroSlides.length;
            showHeroSlide(heroIndex);
        });

        heroNext.addEventListener("click", () => {
            heroIndex = (heroIndex + 1) % heroSlides.length;
            showHeroSlide(heroIndex);
        });

        heroDots.forEach((dot, index) => {
            dot.addEventListener("click", () => {
                heroIndex = index;
                showHeroSlide(heroIndex);
            });
        });

        setInterval(() => {
            heroIndex = (heroIndex + 1) % heroSlides.length;
            showHeroSlide(heroIndex);
        }, 5000);
    }

    /* =========================================================
       HOME - SHIPPING BANNER
    ========================================================= */

    const shippingSlides = document.querySelectorAll(".home-shipping-slide");
    const shippingPrev = document.querySelector(".home-shipping-prev");
    const shippingNext = document.querySelector(".home-shipping-next");

    let shippingIndex = 0;

    function showShippingSlide(index) {
        if (!shippingSlides.length) return;

        shippingSlides.forEach(slide => slide.classList.remove("active"));
        shippingSlides[index].classList.add("active");
    }

    if (shippingPrev && shippingNext && shippingSlides.length) {
        shippingPrev.addEventListener("click", () => {
            shippingIndex = (shippingIndex - 1 + shippingSlides.length) % shippingSlides.length;
            showShippingSlide(shippingIndex);
        });

        shippingNext.addEventListener("click", () => {
            shippingIndex = (shippingIndex + 1) % shippingSlides.length;
            showShippingSlide(shippingIndex);
        });

        setInterval(() => {
            shippingIndex = (shippingIndex + 1) % shippingSlides.length;
            showShippingSlide(shippingIndex);
        }, 4500);
    }
});
// CARROSSEL DO FRETE

const shippingImages = [
    "/images/frete-1.png",
    "/images/frete-2.png",
    "/images/frete-3.png"
];

let currentShipping = 0;

function showShipping(index) {
    const img = document.getElementById("shippingImage");
    img.src = shippingImages[index];
}

function nextShipping() {
    currentShipping = (currentShipping + 1) % shippingImages.length;
    showShipping(currentShipping);
}

function prevShipping() {
    currentShipping =
        (currentShipping - 1 + shippingImages.length) % shippingImages.length;
    showShipping(currentShipping);
}