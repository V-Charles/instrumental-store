@extends('layouts.app')

@section('content')

<div class="products-page">

    <!-- BANNER -->
    <section class="products-hero">
        <img src="{{ asset('images/banner-produtos.jpg') }}" alt="Produtos">

        <div class="products-hero-content">
            <h1>{{ __('messages.products') }}</h1>
        </div>
    </section>

    <!-- FILTRO -->
    <section class="products-filter-bar">
        <div class="products-filter-left">
            <span class="material-symbols-outlined">tune</span>

            <strong>{{ __('messages.filter') }}</strong>

            <select id="categoryFilter" class="products-category-input">
                <option value="todos">{{ __('messages.all_items') }}</option>
                <option value="cordas">{{ __('messages.strings') }}</option>
                <option value="acessorios">{{ __('messages.accessories') }}</option>
                <option value="amplificadores">{{ __('messages.amplifiers') }}</option>
                <option value="pedais">{{ __('messages.pedals') }}</option>
                <option value="percussao">{{ __('messages.percussion') }}</option>
                <option value="audio">{{ __('messages.audio_tech') }}</option>
                <option value="sopro">{{ __('messages.wind') }}</option>
            </select>
        </div>

        <div class="products-filter-divider"></div>

        <p 
            id="productsCount"
            data-showing="{{ __('messages.showing') }}"
            data-of="{{ __('messages.of') }}"
            data-results="{{ __('messages.results') }}"
            data-empty="{{ __('messages.no_products') }}">
        </p>
    </section>

    <!-- LISTA DE PRODUTOS -->
    <section class="products-list">
        <div class="products-grid-page">

            <article class="product-page-card" data-category="cordas">
                <img src="{{ asset('images/guitarra-stratocaster.jpg') }}" alt="Produto">

                <div class="product-page-info">
                    <p class="product-page-brand">Fender</p>
                    <h3>Guitarra Stratocaster</h3>
                    <p class="product-page-price">R$ 3.499,90</p>
                    <p class="product-page-stock">{{ __('messages.in_stock', ['count' => 15]) }}</p>

                    <div class="product-page-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>

                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="product-page-card" data-category="audio">
                <img src="{{ asset('images/teclado-61-teclas.jpg') }}" alt="Produto">

                <div class="product-page-info">
                    <p class="product-page-brand">Casio</p>
                    <h3>Teclado 61 Teclas</h3>
                    <p class="product-page-price">R$ 1.799,90</p>
                    <p class="product-page-stock">{{ __('messages.in_stock', ['count' => 12]) }}</p>

                    <div class="product-page-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>

                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="product-page-card" data-category="cordas">
                <img src="{{ asset('images/ukulele-soprano.jpg') }}" alt="Produto">

                <div class="product-page-info">
                    <p class="product-page-brand">Giannini</p>
                    <h3>Ukulele Soprano</h3>
                    <p class="product-page-price">R$ 799,90</p>
                    <p class="product-page-stock">{{ __('messages.in_stock', ['count' => 12]) }}</p>

                    <div class="product-page-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>

                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="product-page-card" data-category="sopro">
                <img src="{{ asset('images/saxofone-alto.jpg') }}" alt="Produto">

                <div class="product-page-info">
                    <p class="product-page-brand">Weril</p>
                    <h3>Saxofone Alto</h3>
                    <p class="product-page-price">R$ 3.899,90</p>
                    <p class="product-page-stock">{{ __('messages.in_stock', ['count' => 5]) }}</p>

                    <div class="product-page-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>

                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="product-page-card" data-category="audio">
                <img src="{{ asset('images/microfone-condensador.jpg') }}" alt="Produto">

                <div class="product-page-info">
                    <p class="product-page-brand">Shure</p>
                    <h3>Microfone Condensador</h3>
                    <p class="product-page-price">R$ 599,90</p>
                    <p class="product-page-stock">{{ __('messages.in_stock', ['count' => 20]) }}</p>

                    <div class="product-page-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>

                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="product-page-card" data-category="cordas">
                <img src="{{ asset('images/violao-acustico-folk.jpg') }}" alt="Produto">

                <div class="product-page-info">
                    <p class="product-page-brand">Giannini</p>
                    <h3>Violão Acústico Folk</h3>
                    <p class="product-page-price">R$ 1.299,90</p>
                    <p class="product-page-stock">{{ __('messages.in_stock', ['count' => 15]) }}</p>

                    <div class="product-page-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>

                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="product-page-card" data-category="audio">
                <img src="{{ asset('images/piano-digital-88-teclas.jpg') }}" alt="Produto">

                <div class="product-page-info">
                    <p class="product-page-brand">Yamaha</p>
                    <h3>Piano Digital 88 Teclas</h3>
                    <p class="product-page-price">R$ 4.599,90</p>
                    <p class="product-page-stock">{{ __('messages.in_stock', ['count' => 3]) }}</p>

                    <div class="product-page-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>

                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="product-page-card" data-category="cordas">
                <img src="{{ asset('images/violino-4-4-profissional.jpg') }}" alt="Produto">

                <div class="product-page-info">
                    <p class="product-page-brand">Hofma</p>
                    <h3>Violino 4/4 Profissional</h3>
                    <p class="product-page-price">R$ 2.199,90</p>
                    <p class="product-page-stock">{{ __('messages.in_stock', ['count' => 20]) }}</p>

                    <div class="product-page-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>

                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="product-page-card" data-category="cordas">
                <img src="{{ asset('images/guitarra-les-paul.jpg') }}" alt="Produto">

                <div class="product-page-info">
                    <p class="product-page-brand">Gibson</p>
                    <h3>Guitarra Les Paul</h3>
                    <p class="product-page-price">R$ 4.299,90</p>
                    <p class="product-page-stock">{{ __('messages.in_stock', ['count' => 10]) }}</p>

                    <div class="product-page-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>

                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="product-page-card" data-category="cordas">
                <img src="{{ asset('images/violoncelo-4-4.jpg') }}" alt="Produto">

                <div class="product-page-info">
                    <p class="product-page-brand">Yamaha</p>
                    <h3>Violoncelo 4/4</h3>
                    <p class="product-page-price">R$ 4.899,90</p>
                    <p class="product-page-stock">{{ __('messages.in_stock', ['count' => 20]) }}</p>

                    <div class="product-page-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>

                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="product-page-card" data-category="cordas">
                <img src="{{ asset('images/violao-classico-nylon.jpg') }}" alt="Produto">

                <div class="product-page-info">
                    <p class="product-page-brand">Giannini</p>
                    <h3>Violão Clássico Nylon</h3>
                    <p class="product-page-price">R$ 1.299,90</p>
                    <p class="product-page-stock">{{ __('messages.in_stock', ['count' => 25]) }}</p>

                    <div class="product-page-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>

                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="product-page-card" data-category="percussao">
                <img src="{{ asset('images/bateria-acustica.jpg') }}" alt="Produto">

                <div class="product-page-info">
                    <p class="product-page-brand">Pearl</p>
                    <h3>Bateria Acústica Completa</h3>
                    <p class="product-page-price">R$ 5.999,90</p>
                    <p class="product-page-stock">{{ __('messages.in_stock', ['count' => 5]) }}</p>

                    <div class="product-page-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>

                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="product-page-card" data-category="audio">
                <img src="{{ asset('images/bateria-eletronica.jpg') }}" alt="Produto">

                <div class="product-page-info">
                    <p class="product-page-brand">Roland</p>
                    <h3>Bateria Eletrônica</h3>
                    <p class="product-page-price">R$ 3.799,90</p>
                    <p class="product-page-stock">{{ __('messages.in_stock', ['count' => 12]) }}</p>

                    <div class="product-page-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>

                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

        </div>

        <!-- PAGINAÇÃO -->
        <div 
            class="products-pagination"
            id="productsPagination"
            data-next="{{ __('messages.next') }}">
        </div>
    </section>

</div>

@endsection