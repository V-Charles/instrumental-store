@extends('layouts.auth')

@section('content')
<div class="auth-container">

    <div class="auth-left">
        <h2>{{ __('messages.new_password_title') }}</h2>

        <form method="POST" action="{{ route('password.update') }}">
        @csrf

            @if ($errors->any())
                <div style="color: red; margin-bottom: 15px;">{{ $errors->first() }}</div>
            @endif

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <label>{{ __('messages.new_password') }}</label>
            <input type="password" name="password" required>

            <label>{{ __('messages.confirm_password') }}</label>
            <input type="password" name="password_confirmation" required>

            <button type="submit">
                {{ __('messages.send') }}
            </button>
        </form>
    </div>

    <div class="auth-right">
        <img src="{{ asset('images/guitarra.jpg') }}" alt="Guitarra">
    </div>

</div>
@endsection