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

        heroSlides.forEach((slide) => slide.classList.remove("active"));
        heroDots.forEach((dot) => dot.classList.remove("active"));

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

        shippingSlides.forEach((slide) => slide.classList.remove("active"));
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

/* =========================================================
   HOME - CARROSSEL DO FRETE
========================================================= */

const shippingImages = [
    "/images/frete-1.png",
    "/images/frete-2.png",
    "/images/frete-3.png"
];

let currentShipping = 0;

function showShipping(index) {
    const img = document.getElementById("shippingImage");

    if (!img) return;

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

/* =========================================================
   DETALHES DO PRODUTO - GALERIA, CORES E QUANTIDADE
========================================================= */

const productThumbs = document.querySelectorAll(".product-thumb");
const mainProductImage = document.getElementById("mainProductImage");
const productColors = document.querySelectorAll(".product-color");

const decreaseQuantity = document.getElementById("decreaseQuantity");
const increaseQuantity = document.getElementById("increaseQuantity");
const productQuantity = document.getElementById("productQuantity");

if (productThumbs.length > 0 && mainProductImage) {
    productThumbs.forEach((thumb) => {
        thumb.addEventListener("click", () => {
            const newImage = thumb.dataset.image;

            mainProductImage.src = newImage;

            productThumbs.forEach((item) => item.classList.remove("active"));
            thumb.classList.add("active");

            productColors.forEach((color) => {
                color.classList.toggle("active", color.dataset.image === newImage);
            });
        });
    });
}

if (productColors.length > 0 && mainProductImage) {
    productColors.forEach((color) => {
        color.addEventListener("click", () => {
            const newImage = color.dataset.image;

            mainProductImage.src = newImage;

            productColors.forEach((item) => item.classList.remove("active"));
            color.classList.add("active");

            productThumbs.forEach((thumb) => {
                thumb.classList.toggle("active", thumb.dataset.image === newImage);
            });
        });
    });
}

if (decreaseQuantity && increaseQuantity && productQuantity) {
    let quantity = 1;

    increaseQuantity.addEventListener("click", () => {
        quantity++;
        productQuantity.textContent = quantity;
    });

    decreaseQuantity.addEventListener("click", () => {
        if (quantity > 1) {
            quantity--;
            productQuantity.textContent = quantity;
        }
    });
}

/* =========================================================
   ÁREA DO CLIENTE - BANDEIRA PELO CÓDIGO DO PAÍS
========================================================= */

const countryInput = document.getElementById('country-code-input');
const countryFlag = document.getElementById('country-flag-preview');

const countryCodes = {
    '1': 'us',
    '7': 'ru',
    '20': 'eg',
    '27': 'za',
    '30': 'gr',
    '31': 'nl',
    '32': 'be',
    '33': 'fr',
    '34': 'es',
    '39': 'it',
    '41': 'ch',
    '44': 'gb',
    '45': 'dk',
    '46': 'se',
    '47': 'no',
    '48': 'pl',
    '49': 'de',
    '51': 'pe',
    '52': 'mx',
    '54': 'ar',
    '55': 'br',
    '56': 'cl',
    '57': 'co',
    '58': 've',
    '61': 'au',
    '64': 'nz',
    '81': 'jp',
    '82': 'kr',
    '86': 'cn',
    '91': 'in',
    '351': 'pt',
    '352': 'lu',
    '353': 'ie',
    '354': 'is',
    '355': 'al',
    '358': 'fi',
    '380': 'ua',
    '420': 'cz',
    '421': 'sk',
    '591': 'bo',
    '593': 'ec',
    '595': 'py',
    '598': 'uy'
};

function updateCountryFlag() {
    if (!countryInput || !countryFlag) {
        return;
    }

    const typedCode = countryInput.value.trim();
    const countryCode = countryCodes[typedCode];

    if (countryCode) {
        countryFlag.src = `https://flagcdn.com/24x18/${countryCode}.png`;
        countryFlag.style.display = 'block';
    } else {
        countryFlag.src = '';
        countryFlag.style.display = 'none';
    }
}

if (countryInput && countryFlag) {
    updateCountryFlag();

    countryInput.addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '');
        updateCountryFlag();
    });

    countryFlag.addEventListener('error', function () {
        this.style.display = 'none';
    });
}