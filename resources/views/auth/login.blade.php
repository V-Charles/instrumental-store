@extends('layouts.auth')

@section('content')
<div class="auth-container">

    <div class="auth-left">
        <h2>{{ __('messages.login') }}</h2>

        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 5px;">
                <strong style="display:block; margin-bottom: 5px;">Ops! Encontramos um problema:</strong>
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <label>{{ __('messages.email') }}</label>
            <input type="email" name="email" required>

            <label>{{ __('messages.password') }}</label>
            <input type="password" name="password" required>

            <a href="{{ route('password.request') }}" class="forgot">
                {{ __('messages.forgot_password') }}
            </a>

            <button type="submit">
                {{ __('messages.login') }}
            </button>
</a>
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