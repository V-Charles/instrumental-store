@extends('layouts.auth')

@section('content')
<div class="auth-container">

    <div class="auth-left">
        <h2>Login</h2>

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <label>E-mail</label>
            <input type="email" name="email" required>

            <label>Senha</label>
            <input type="password" name="password" required>

            <a href="#" class="forgot">esqueceu sua senha?</a>

            <button type="submit">Entrar</button>

            <p class="divider">ou</p>

            <button type="button" class="google-btn">
                Login com Google
            </button>

            <p class="register">
                Não possui conta?
                <a href="{{ route('register') }}">Cadastre-se aqui!</a>
            </p>
        </form>
    </div>

    <div class="auth-right">
        <img src="{{ asset('images/guitarra.jpg') }}" alt="Guitarra">
    </div>

</div>
@endsection