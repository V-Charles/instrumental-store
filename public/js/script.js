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

/* =========================================================
   PRODUTOS - FILTRO E PAGINAÇÃO
========================================================= */

const categoryFilter = document.getElementById("categoryFilter");
const productsCount = document.getElementById("productsCount");
const productsPagination = document.getElementById("productsPagination");
const productCards = Array.from(document.querySelectorAll(".product-page-card"));

const productsPerPage = 12;
let currentPage = 1;
let filteredProducts = productCards;

function updateProductsCount() {
    if (!productsCount) return;

    const totalFiltered = filteredProducts.length;

    if (totalFiltered === 0) {
        productsCount.textContent = productsCount.dataset.empty;
        return;
    }

    const start = (currentPage - 1) * productsPerPage + 1;
    const end = Math.min(currentPage * productsPerPage, totalFiltered);

    productsCount.textContent =
        `${productsCount.dataset.showing} ${start}-${end} ${productsCount.dataset.of} ${totalFiltered} ${productsCount.dataset.results}`;
}

function renderProductsPage(page) {
    currentPage = page;

    productCards.forEach((card) => {
        card.style.display = "none";
    });

    const start = (currentPage - 1) * productsPerPage;
    const end = start + productsPerPage;

    filteredProducts.slice(start, end).forEach((card) => {
        card.style.display = "block";
    });

    renderPagination();
    updateProductsCount();
}

function renderPagination() {
    if (!productsPagination) return;

    productsPagination.innerHTML = "";

    const totalPages = Math.ceil(filteredProducts.length / productsPerPage);

    if (totalPages <= 1) return;

    for (let i = 1; i <= totalPages; i++) {
        const pageButton = document.createElement("button");

        pageButton.type = "button";
        pageButton.textContent = i;
        pageButton.classList.add("products-page-link");

        if (i === currentPage) {
            pageButton.classList.add("active");
        }

        pageButton.addEventListener("click", () => {
            renderProductsPage(i);
        });

        productsPagination.appendChild(pageButton);
    }

    if (currentPage < totalPages) {
        const nextButton = document.createElement("button");

        nextButton.type = "button";
        nextButton.textContent = productsPagination.dataset.next;
        nextButton.classList.add("products-page-link", "products-page-next");

        nextButton.addEventListener("click", () => {
            renderProductsPage(currentPage + 1);
        });

        productsPagination.appendChild(nextButton);
    }
}

function filterProducts() {
    if (!categoryFilter) return;

    const selectedCategory = categoryFilter.value;

    if (selectedCategory === "todos") {
        filteredProducts = productCards;
    } else {
        filteredProducts = productCards.filter((card) => {
            return card.dataset.category === selectedCategory;
        });
    }

    currentPage = 1;
    renderProductsPage(currentPage);
}

if (categoryFilter && productsCount && productsPagination && productCards.length > 0) {
    const urlParams = new URLSearchParams(window.location.search);
    const categoryFromUrl = urlParams.get("categoria");

    if (categoryFromUrl) {
        categoryFilter.value = categoryFromUrl;
    }

    filterProducts();

    categoryFilter.addEventListener("change", filterProducts);
}