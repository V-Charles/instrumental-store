@extends('layouts.app')

@section('content')

<div class="order-success-page">

    <section class="order-success-hero">
        <img src="{{ asset('images/banner-produtos.jpg') }}" alt="{{ __('messages.purchase_completed') }}">

        <div class="order-success-hero-content">
            <h1>
                {{ __('messages.thank_you_purchase') }}
            </h1>
        </div>
    </section>

    <section class="order-success-content">

        <div class="order-success-box">

            <p>
                {{ __('messages.purchase_success_message') }}
            </p>

            <span class="material-symbols-outlined">
                check_circle
            </span>

        </div>

    </section>

</div>

@endsection