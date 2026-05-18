@extends('layouts.auth')

@section('content')
<div class="auth-container">

    <div class="auth-left">
        <h2>{{ __('messages.new_password_title') }}</h2>

        <form method="POST" action="#">
            @csrf

            <label>{{ __('messages.new_password') }}</label>
            <input type="password" name="password" required>

            <label>{{ __('messages.confirm_password') }}</label>
            <input type="password" name="password_confirmation" required>

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