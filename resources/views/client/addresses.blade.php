@extends('layouts.app')

@section('content')

<div class="client-page">

    <input type="checkbox" id="client-menu-toggle">

    <div class="client-breadcrumb-bar">
        <label for="client-menu-toggle" class="client-menu-button">
            <span class="material-symbols-outlined">menu</span>
        </label>

        <span>{{ __('messages.home') }}</span>
        <span class="client-separator">></span>
        <span>{{ __('messages.addresses') }}</span>
    </div>

    <div class="client-main-container">

        @include('client.partials.sidebar')

        <main class="client-content">

            <section class="client-address-page">

                <h2>{{ __('messages.addresses') }}</h2>

                <div class="client-address-grid">

                    <article class="client-address-card">
                        <h3>{{ __('messages.home_address') }}</h3>

                        <p>
                            Rua teste, número 001, Vila teste,<br>
                            São Paulo - SP, Brasil
                        </p>

                        <p>
                            CEP: 12345-678
                        </p>

                        <div class="client-address-actions">
                            <button type="button" class="client-address-edit">
                                {{ __('messages.edit') }}
                            </button>

                            <button type="button" class="client-address-delete">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </article>

                    <article class="client-address-card">
                        <h3>{{ __('messages.work_address') }}</h3>

                        <p>
                            Avenida exemplo, número 200, Centro,<br>
                            São Paulo - SP, Brasil
                        </p>

                        <p>
                            CEP: 00000-000
                        </p>

                        <div class="client-address-actions">
                            <button type="button" class="client-address-edit">
                                {{ __('messages.edit') }}
                            </button>

                            <button type="button" class="client-address-delete">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </article>

                    <article class="client-address-card">
                        <h3>{{ __('messages.additional_address') }}</h3>

                        <p>
                            Rua das Flores, número 50, Jardim Central,<br>
                            São Paulo - SP, Brasil
                        </p>

                        <p>
                            CEP: 11111-111
                        </p>

                        <div class="client-address-actions">
                            <button type="button" class="client-address-edit">
                                {{ __('messages.edit') }}
                            </button>

                            <button type="button" class="client-address-delete">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </article>

                    <article class="client-address-card">
                        <h3>{{ __('messages.other_address') }}</h3>

                        <p>
                            Rua São Bento, número 400, Bela Vista,<br>
                            São Paulo - SP, Brasil
                        </p>

                        <p>
                            CEP: 22222-222
                        </p>

                        <div class="client-address-actions">
                            <button type="button" class="client-address-edit">
                                {{ __('messages.edit') }}
                            </button>

                            <button type="button" class="client-address-delete">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </article>

                </div>

                <div class="client-address-new">
                    <button type="button" class="client-btn client-btn-primary">
                        {{ __('messages.register_new') }}
                    </button>
                </div>

            </section>

        </main>

    </div>

</div>

@endsection