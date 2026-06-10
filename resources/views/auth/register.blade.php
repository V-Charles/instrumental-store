@extends('layouts.auth')

@section('content')
<div class="auth-container">

    <div class="auth-left">
        <h2>{{ __('messages.create_account') }}</h2>

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf
            
            <label>Nome Completo</label>
            <input type="text" name="name" required>

            <label>CPF</label>
            <input type="text" name="cpf" required>

            <label>{{ __('messages.email') }}</label>
            <input type="email" name="email" required>

            <label>{{ __('messages.username') }}</label>
            <input type="text" name="username" required>

            <label>{{ __('messages.password') }}</label>
            <input type="password" name="password" required>

            <label>{{ __('messages.confirm_password') }}</label>
            <input type="password" name="password_confirmation" required>

            <button type="submit">{{ __('messages.create_account') }}</button>
        </form>
    </div>

    <div class="auth-right">
        <img src="{{ asset('images/guitarra.jpg') }}" alt="Guitarra">
    </div>

</div>
@endsection