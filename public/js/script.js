/* =========================================================
   LOGIN / CADASTRO
========================================================= */

function togglePassword(id) {
    const input = document.getElementById(id);

    if (!input) {
        return;
    }

    input.type = input.type === "password" ? "text" : "password";
}

/* =========================================================
   HOME - CARROSSEL DO FRETE
   Mantido fora do DOMContentLoaded porque é chamado no HTML
========================================================= */

const shippingImages = [
    "/images/frete-1.png",
    "/images/frete-2.png",
    "/images/frete-3.png"
];

let currentShipping = 0;

function showShipping(index) {
    const img = document.getElementById("shippingImage");

    if (!img) {
        return;
    }

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
   SCRIPTS DA PÁGINA
========================================================= */

document.addEventListener("DOMContentLoaded", function () {

    /* =========================================================
       HOME - HERO
    ========================================================= */

    const heroSlides = document.querySelectorAll(".home-hero-slide");
    const heroDots = document.querySelectorAll(".home-hero-dots span");
    const heroPrev = document.querySelector(".home-hero-prev");
    const heroNext = document.querySelector(".home-hero-next");

    let heroIndex = 0;

    function showHeroSlide(index) {
        if (!heroSlides.length) {
            return;
        }

        heroSlides.forEach(function (slide) {
            slide.classList.remove("active");
        });

        heroDots.forEach(function (dot) {
            dot.classList.remove("active");
        });

        heroSlides[index].classList.add("active");

        if (heroDots[index]) {
            heroDots[index].classList.add("active");
        }
    }

    if (heroPrev && heroNext && heroSlides.length) {
        heroPrev.addEventListener("click", function () {
            heroIndex = (heroIndex - 1 + heroSlides.length) % heroSlides.length;
            showHeroSlide(heroIndex);
        });

        heroNext.addEventListener("click", function () {
            heroIndex = (heroIndex + 1) % heroSlides.length;
            showHeroSlide(heroIndex);
        });

        heroDots.forEach(function (dot, index) {
            dot.addEventListener("click", function () {
                heroIndex = index;
                showHeroSlide(heroIndex);
            });
        });

        setInterval(function () {
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
        if (!shippingSlides.length) {
            return;
        }

        shippingSlides.forEach(function (slide) {
            slide.classList.remove("active");
        });

        shippingSlides[index].classList.add("active");
    }

    if (shippingPrev && shippingNext && shippingSlides.length) {
        shippingPrev.addEventListener("click", function () {
            shippingIndex = (shippingIndex - 1 + shippingSlides.length) % shippingSlides.length;
            showShippingSlide(shippingIndex);
        });

        shippingNext.addEventListener("click", function () {
            shippingIndex = (shippingIndex + 1) % shippingSlides.length;
            showShippingSlide(shippingIndex);
        });

        setInterval(function () {
            shippingIndex = (shippingIndex + 1) % shippingSlides.length;
            showShippingSlide(shippingIndex);
        }, 4500);
    }

    /* =========================================================
       DETALHES DO PRODUTO - MINIATURAS E QUANTIDADE
    ========================================================= */

    const detailThumbs = document.querySelectorAll(".product-thumb img");
    const detailMainImage = document.getElementById("mainProductImage");

    if (detailThumbs.length > 0 && detailMainImage) {
        detailThumbs.forEach(function (thumb) {
            thumb.addEventListener("click", function () {
                detailMainImage.src = this.src;

                document.querySelectorAll(".product-thumb").forEach(function (button) {
                    button.classList.remove("active");
                });

                const buttonParent = this.closest(".product-thumb");

                if (buttonParent) {
                    buttonParent.classList.add("active");
                }
            });
        });
    }

    const decreaseButton = document.getElementById("decreaseQuantity");
    const increaseButton = document.getElementById("increaseQuantity");
    const quantityText = document.getElementById("productQuantity");

    if (decreaseButton && increaseButton && quantityText) {
        decreaseButton.addEventListener("click", function () {
            let quantity = Number(quantityText.textContent);

            if (quantity > 1) {
                quantityText.textContent = quantity - 1;
            }
        });

        increaseButton.addEventListener("click", function () {
            let quantity = Number(quantityText.textContent);

            quantityText.textContent = quantity + 1;
        });
    }

    /* =========================================================
       ÁREA DO CLIENTE - BANDEIRA PELO CÓDIGO DO PAÍS
    ========================================================= */

    const countryInput = document.getElementById("country-code-input");
    const countryFlag = document.getElementById("country-flag-preview");

    const countryCodes = {
        "1": "us",
        "7": "ru",
        "20": "eg",
        "27": "za",
        "30": "gr",
        "31": "nl",
        "32": "be",
        "33": "fr",
        "34": "es",
        "39": "it",
        "41": "ch",
        "44": "gb",
        "45": "dk",
        "46": "se",
        "47": "no",
        "48": "pl",
        "49": "de",
        "51": "pe",
        "52": "mx",
        "54": "ar",
        "55": "br",
        "56": "cl",
        "57": "co",
        "58": "ve",
        "61": "au",
        "64": "nz",
        "81": "jp",
        "82": "kr",
        "86": "cn",
        "91": "in",
        "351": "pt",
        "352": "lu",
        "353": "ie",
        "354": "is",
        "355": "al",
        "358": "fi",
        "380": "ua",
        "420": "cz",
        "421": "sk",
        "591": "bo",
        "593": "ec",
        "595": "py",
        "598": "uy"
    };

    function updateCountryFlag() {
        if (!countryInput || !countryFlag) {
            return;
        }

        const typedCode = countryInput.value.trim();
        const countryCode = countryCodes[typedCode];

        if (countryCode) {
            countryFlag.src = `https://flagcdn.com/24x18/${countryCode}.png`;
            countryFlag.style.display = "block";
        } else {
            countryFlag.src = "";
            countryFlag.style.display = "none";
        }
    }

    if (countryInput && countryFlag) {
        updateCountryFlag();

        countryInput.addEventListener("input", function () {
            this.value = this.value.replace(/\D/g, "");
            updateCountryFlag();
        });

        countryFlag.addEventListener("error", function () {
            this.style.display = "none";
        });
    }

    /* =========================================================
       MINI CARRINHO
    ========================================================= */

    const miniCartButton = document.getElementById("miniCartButton");
    const miniCartBox = document.getElementById("miniCartBox");
    const closeMiniCart = document.getElementById("closeMiniCart");

    if (miniCartButton && miniCartBox) {
        miniCartButton.addEventListener("click", function (event) {
            event.preventDefault();
            event.stopPropagation();

            miniCartBox.classList.toggle("active");
        });

        miniCartBox.addEventListener("click", function (event) {
            event.stopPropagation();
        });

        document.addEventListener("click", function () {
            miniCartBox.classList.remove("active");
        });
    }

    if (closeMiniCart && miniCartBox) {
        closeMiniCart.addEventListener("click", function (event) {
            event.preventDefault();
            event.stopPropagation();

            miniCartBox.classList.remove("active");
        });
    }
});

/* =========================================================
   PAGAMENTO - SELEÇÃO DE FORMA DE PAGAMENTO
========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    const paymentMethod = document.getElementById("payment_method");
    const paymentFinishButton = document.getElementById("paymentFinishButton");

    if (paymentMethod && paymentFinishButton) {
        paymentMethod.addEventListener("change", function () {
            if (this.value === "pix") {
                paymentFinishButton.href = "/pagamento-pix";
            } else {
                paymentFinishButton.href = "/compra-realizada";
            }
        });
    }
});

/* =========================================================
   PIX - COPIAR CÓDIGO
========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    const copyPixButton = document.getElementById("copyPixButton");
    const pixCode = document.getElementById("pixCode");
    const pixCopyMessage = document.getElementById("pixCopyMessage");

    if (copyPixButton && pixCode) {
        copyPixButton.addEventListener("click", function () {
            pixCode.select();
            pixCode.setSelectionRange(0, 99999);

            navigator.clipboard.writeText(pixCode.value);

            if (pixCopyMessage) {
                pixCopyMessage.classList.add("active");

                setTimeout(function () {
                    pixCopyMessage.classList.remove("active");
                }, 2000);
            }
        });
    }
});

/* =========================================================
   CARRINHO - ATUALIZAÇÃO DINÂMICA (+ e -)
========================================================= */
document.addEventListener("submit", async function (e) {
    const form = e.target.closest(".cart-quantity form");
    
    if (form) {
        e.preventDefault();

        const btn = form.querySelector("button");
        if (btn) btn.disabled = true;

        await fetch(form.action, {
            method: "POST",
            body: new FormData(form),
        });

        const response = await fetch(window.location.href);
        const html = await response.text();
        const doc = new DOMParser().parseFromString(html, "text/html");
        const novaTabela = doc.querySelector(".cart-content");
        const novoCabecalho = doc.querySelector(".mini-cart-wrapper");

        if (novaTabela) document.querySelector(".cart-content").innerHTML = novaTabela.innerHTML;
        if (novoCabecalho) document.querySelector(".mini-cart-wrapper").innerHTML = novoCabecalho.innerHTML;
    }
});