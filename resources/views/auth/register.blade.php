@extends('layouts.auth')

@section('content')
<div class="auth-container">

    <div class="auth-left">
        <h2>Criar conta</h2>

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <label>E-mail</label>
            <input type="email" name="email" required>

            <label>Usuário</label>
            <input type="text" name="username" required>

            <label>Senha</label>
            <input type="password" name="password" required>

            <label>Confirme sua senha</label>
            <input type="password" name="password_confirmation" required>

            <button type="submit">Criar conta</button>
        </form>
    </div>

    <div class="auth-right">
        <img src="{{ asset('images/guitarra.jpg') }}" alt="Guitarra">
    </div>

</div>
@endsection