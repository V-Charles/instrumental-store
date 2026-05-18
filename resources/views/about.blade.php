@extends('layouts.app')

@section('content')
<div class="about-page">

<section class="home-hero">
    <div class="home-hero-banner">
        <img src="{{ asset('images/banner-home.jpg') }}" alt="Banner principal">

        <div class="home-hero-overlay">
            <div class="home-hero-card">
                <h1>{!! __('messages.hero_title') !!}</h1>

                <p class="home-hero-description">
                    {{ __('messages.hero_description') }}
                </p>

                <a href="/produtos" class="home-hero-button">
                    {{ __('messages.buy') }}
                </a>
            </div>
        </div>
    </div>
</section>

    <section class="about-intro">
        <h2>{{ __('messages.about_title') }}</h2>

        <p>{{ __('messages.about_text_1') }}</p>
        <p>{{ __('messages.about_text_2') }}</p>
        <p>{{ __('messages.about_text_3') }}</p>
    </section>

    <section class="about-timeline">
        <h2>{{ __('messages.timeline_title') }}</h2>

        <div class="timeline-item">
            <span>1968</span>
            <div>
                <h3>{{ __('messages.timeline_1968_title') }}</h3>
                <p>{{ __('messages.timeline_1968_text') }}</p>
            </div>
        </div>

        <div class="timeline-item">
            <span>2005</span>
            <div>
                <h3>{{ __('messages.timeline_2005_title') }}</h3>
                <p>{{ __('messages.timeline_2005_text') }}</p>
            </div>
        </div>

        <div class="timeline-item">
            <span>2020</span>
            <div>
                <h3>{{ __('messages.timeline_2020_title') }}</h3>
                <p>{{ __('messages.timeline_2020_text') }}</p>
            </div>
        </div>

        <div class="timeline-item">
            <span>2025</span>
            <div>
                <h3>{{ __('messages.timeline_2025_title') }}</h3>
                <p>{{ __('messages.timeline_2025_text') }}</p>
            </div>
        </div>
    </section>

    <section class="about-values">
        <div class="about-value-card">
            <span class="material-symbols-outlined">favorite</span>
            <h3>{{ __('messages.value_passion_title') }}</h3>
            <p>{{ __('messages.value_passion_text') }}</p>
        </div>

        <div class="about-value-card">
            <span class="material-symbols-outlined">verified</span>
            <h3>{{ __('messages.value_quality_title') }}</h3>
            <p>{{ __('messages.value_quality_text') }}</p>
        </div>

        <div class="about-value-card">
            <span class="material-symbols-outlined">groups</span>
            <h3>{{ __('messages.value_service_title') }}</h3>
            <p>{{ __('messages.value_service_text') }}</p>
        </div>
    </section>

    <section class="about-objective">
        <h2>{{ __('messages.objective_title') }}</h2>
        <p>{{ __('messages.objective_text') }}</p>
    </section>

</div>
@endsection