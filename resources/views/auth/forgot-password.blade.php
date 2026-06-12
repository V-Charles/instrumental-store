@extends('layouts.auth')

@section('content')
<div class="auth-container">

    <div class="auth-left">
        <h2>{{ __('messages.forgot_password_title') }}</h2>

        @if (session('success'))
            <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">{{ $errors->first() }}</div>
        @endif

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