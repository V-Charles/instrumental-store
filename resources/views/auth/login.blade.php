@extends('layouts.auth')

@section('content')
<div class="auth-container">

    <div class="auth-left">
        <h2>{{ __('messages.login') }}</h2>

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <label>{{ __('messages.email') }}</label>
            <input type="email" name="email" required>

            <label>{{ __('messages.password') }}</label>
            <input type="password" name="password" required>

            <a href="{{ route('password.forgot') }}" class="forgot">
                {{ __('messages.forgot_password') }}
            </a>

            <button type="submit">
                {{ __('messages.login') }}
            </button>

            <p class="divider">ou</p>

            <button type="button" class="google-btn">
                {{ __('messages.login_google') }}
            </button>

            <p class="register">
                {{ __('messages.dont_have_account') }}

                <a href="{{ route('register') }}">
                    {{ __('messages.register_here') }}
                </a>
            </p>
        </form>
    </div>

    <div class="auth-right">
        <img src="{{ asset('images/guitarra.jpg') }}" alt="Guitarra">
    </div>

</div>
@endsection