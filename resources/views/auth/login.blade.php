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

            <p class="divider">ou</p>

           <a href="{{ route('google.login') }}" class="google-btn">

            <svg xmlns="http://www.w3.org/2000/svg"
             width="20"
             height="20"
            viewBox="0 0 48 48">

            <path fill="#FFC107"
                d="M43.611 20.083H42V20H24v8h11.303C33.651 32.657
                29.193 36 24 36c-6.627 0-12-5.373-12-12
                s5.373-12 12-12c3.059 0 5.842 1.154
                7.961 3.039l5.657-5.657C34.046 6.053
                29.268 4 24 4 12.955 4 4 12.955
                4 24s8.955 20 20 20 20-8.955
                20-20c0-1.341-.138-2.65-.389-3.917z"/>

            <path fill="#FF3D00"
                d="M6.306 14.691l6.571 4.819C14.655
                15.108 18.961 12 24 12c3.059 0
                5.842 1.154 7.961 3.039l5.657-5.657C34.046
                6.053 29.268 4 24 4c-7.682 0-14.41
                4.337-17.694 10.691z"/>

            <path fill="#4CAF50"
                d="M24 44c5.166 0 9.86-1.977
                13.409-5.192l-6.19-5.238C29.143
                35.091 26.715 36 24 36c-5.173
                0-9.625-3.33-11.283-7.946l-6.522
                5.025C9.435 39.556 16.227 44 24 44z"/>

            <path fill="#1976D2"
                d="M43.611 20.083H42V20H24v8h11.303c-1.058
                3.118-3.289 5.548-6.084
                6.97l.003-.002 6.19
                5.238C35.994 39.889 44
                34 44 24c0-1.341-.138-2.65-.389-3.917z"/>
            </svg>

    <span>Entrar com Google</span>

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