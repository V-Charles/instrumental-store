@extends('layouts.auth')

@section('content')
<div class="auth-container">

    <div class="auth-left">
        <h2>{{ __('messages.forgot_password_title') }}</h2>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <label>{{ __('messages.email') }}</label>
            <input type="email" name="email" required>

            <button type="submit">
                {{ __('messages.send') }}
            </button>

            <a href="{{ route('login') }}" class="forgot">
                {{ __('messages.back') }}
            </a>
        </form>
    </div>

    <div class="auth-right">
        <img src="{{ asset('images/guitarra.jpg') }}" alt="Guitarra">
    </div>

</div>
@endsection