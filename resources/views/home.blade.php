@extends('layouts.app')

@section('content')
<div class="home-page">

    <!-- =========================================================
         HERO
    ========================================================== -->
    <section class="home-hero">
        <div class="home-hero-banner">
            <img src="{{ asset('images/banner-home.jpg') }}" alt="Banner principal">

            <div class="home-hero-categories">
                <span>Acessórios</span>
                <span>Cordas</span>
                <span>Amplificadores</span>
                <span>Pedais/Pedaleiras</span>
                <span>Percussão</span>
                <span>Áudio e Tecnologia</span>
                <span>Sopro</span>
            </div>

            <div class="home-hero-overlay">
                <div class="home-hero-card">
                    <h1>Descubra Seu<br>Novo Som</h1>

                    <p class="home-hero-description">
                        Cada instrumento carrega um som único. Encontre aquele
                        que vai contar a sua história.
                    </p>

                    <a href="/produtos" class="home-hero-button">COMPRAR</a>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================
         PRODUTOS MAIS VENDIDOS
    ========================================================== -->
    <section class="home-section">
        <h2 class="home-section-title">Produtos mais vendidos</h2>
        <p class="home-section-subtitle">
            conheça os produtos mais vendidos da Instrumental Store
        </p>

        <div class="home-products-grid">
            <article class="home-product-card">
                <img src="{{ asset('images/mais-vendido-1.jpg') }}" alt="Produto">
                <div class="home-product-info">
                    <p class="home-product-brand">Fender</p>
                    <h3>Guitarra Stratocaster</h3>
                    <p class="home-product-price">R$ 3.499,90</p>
                    <p class="home-product-stock">15 em estoque</p>

                    <div class="home-product-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            Adicionar
                        </button>
                        <button class="home-btn home-btn--secondary">Detalhes</button>
                    </div>
                </div>
            </article>

            <article class="home-product-card">
                <img src="{{ asset('images/mais-vendido-2.jpg') }}" alt="Produto">
                <div class="home-product-info">
                    <p class="home-product-brand">Gibson</p>
                    <h3>Guitarra Les Paul</h3>
                    <p class="home-product-price">R$ 4.299,90</p>
                    <p class="home-product-stock">10 em estoque</p>

                    <div class="home-product-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            Adicionar
                        </button>
                        <button class="home-btn home-btn--secondary">Detalhes</button>
                    </div>
                </div>
            </article>

            <article class="home-product-card">
                <img src="{{ asset('images/mais-vendido-3.jpg') }}" alt="Produto">
                <div class="home-product-info">
                    <p class="home-product-brand">Yamaha</p>
                    <h3>Violão Acústico Folk</h3>
                    <p class="home-product-price">R$ 1.899,90</p>
                    <p class="home-product-stock">20 em estoque</p>

                    <div class="home-product-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            Adicionar
                        </button>
                        <button class="home-btn home-btn--secondary">Detalhes</button>
                    </div>
                </div>
            </article>

            <article class="home-product-card">
                <img src="{{ asset('images/mais-vendido-4.jpg') }}" alt="Produto">
                <div class="home-product-info">
                    <p class="home-product-brand">Giannini</p>
                    <h3>Violão Clássico Nylon</h3>
                    <p class="home-product-price">R$ 1.299,90</p>
                    <p class="home-product-stock">25 em estoque</p>

                    <div class="home-product-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            Adicionar
                        </button>
                        <button class="home-btn home-btn--secondary">Detalhes</button>
                    </div>
                </div>
            </article>

            <article class="home-product-card">
                <img src="{{ asset('images/mais-vendido-5.jpg') }}" alt="Produto">
                <div class="home-product-info">
                    <p class="home-product-brand">Pearl</p>
                    <h3>Bateria Acústica Completa</h3>
                    <p class="home-product-price">R$ 5.999,90</p>
                    <p class="home-product-stock">5 em estoque</p>

                    <div class="home-product-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            Adicionar
                        </button>
                        <button class="home-btn home-btn--secondary">Detalhes</button>
                    </div>
                </div>
            </article>

            <article class="home-product-card">
                <img src="{{ asset('images/mais-vendido-6.jpg') }}" alt="Produto">
                <div class="home-product-info">
                    <p class="home-product-brand">Roland</p>
                    <h3>Bateria Eletrônica</h3>
                    <p class="home-product-price">R$ 3.799,90</p>
                    <p class="home-product-stock">12 em estoque</p>

                    <div class="home-product-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            Adicionar
                        </button>
                        <button class="home-btn home-btn--secondary">Detalhes</button>
                    </div>
                </div>
            </article>
        </div>
    </section>

    <!-- =========================================================
         BANNER FRETE
    ========================================================== -->
<section class="home-shipping">
    <div class="home-shipping-wrapper">

        <button class="home-shipping-arrow" onclick="prevShipping()">‹</button>

        <div class="home-shipping-banner">
            <img id="shippingImage" src="{{ asset('images/frete-1.png') }}">
        </div>

        <button class="home-shipping-arrow" onclick="nextShipping()">›</button>

    </div>
</section>

    <!-- =========================================================
         OUTROS PRODUTOS
    ========================================================== -->
    <section class="home-other">
        <h2>Outros produtos</h2>

        <div class="home-other-grid">
            <article class="home-other-card">
                <img src="{{ asset('images/outro-1.jpg') }}" alt="Produto">
                <div class="home-other-info">
                    <p class="home-other-brand">Ibanez</p>
                    <h3>Contrabaixo 4 cordas</h3>
                    <p class="home-other-price">R$ 2.459,90</p>
                    <p class="home-other-stock">15 em estoque</p>

                    <div class="home-other-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            Adicionar
                        </button>
                        <button class="home-btn home-btn--secondary">Detalhes</button>
                    </div>
                </div>
            </article>

            <article class="home-other-card">
                <img src="{{ asset('images/outro-2.jpg') }}" alt="Produto">
                <div class="home-other-info">
                    <p class="home-other-brand">Music Man</p>
                    <h3>Contrabaixo 5 cordas</h3>
                    <p class="home-other-price">R$ 3.299,90</p>
                    <p class="home-other-stock">5 em estoque</p>

                    <div class="home-other-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            Adicionar
                        </button>
                        <button class="home-btn home-btn--secondary">Detalhes</button>
                    </div>
                </div>
            </article>

            <article class="home-other-card">
                <img src="{{ asset('images/outro-3.jpg') }}" alt="Produto">
                <div class="home-other-info">
                    <p class="home-other-brand">Casio</p>
                    <h3>Teclado 61 teclas</h3>
                    <p class="home-other-price">R$ 1.799,90</p>
                    <p class="home-other-stock">18 em estoque</p>

                    <div class="home-other-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            Adicionar
                        </button>
                        <button class="home-btn home-btn--secondary">Detalhes</button>
                    </div>
                </div>
            </article>

            <article class="home-other-card">
                <img src="{{ asset('images/outro-4.jpg') }}" alt="Produto">
                <div class="home-other-info">
                    <p class="home-other-brand">Yamaha</p>
                    <h3>Piano Digital 88 Teclas</h3>
                    <p class="home-other-price">R$ 4.599,90</p>
                    <p class="home-other-stock">7 em estoque</p>

                    <div class="home-other-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            Adicionar
                        </button>
                        <button class="home-btn home-btn--secondary">Detalhes</button>
                    </div>
                </div>
            </article>

            <article class="home-other-card">
                <img src="{{ asset('images/outro-5.jpg') }}" alt="Produto">
                <div class="home-other-info">
                    <p class="home-other-brand">Hofma</p>
                    <h3>Violino 4/4 Completo</h3>
                    <p class="home-other-price">R$ 2.199,90</p>
                    <p class="home-other-stock">12 em estoque</p>

                    <div class="home-other-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            Adicionar
                        </button>
                        <button class="home-btn home-btn--secondary">Detalhes</button>
                    </div>
                </div>
            </article>

            <article class="home-other-card">
                <img src="{{ asset('images/outro-6.jpg') }}" alt="Produto">
                <div class="home-other-info">
                    <p class="home-other-brand">Weril</p>
                    <h3>Saxofone Alto</h3>
                    <p class="home-other-price">R$ 3.899,90</p>
                    <p class="home-other-stock">9 em estoque</p>

                    <div class="home-other-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            Adicionar
                        </button>
                        <button class="home-btn home-btn--secondary">Detalhes</button>
                    </div>
                </div>
            </article>
        </div>
    </section>

</div>
@endsection