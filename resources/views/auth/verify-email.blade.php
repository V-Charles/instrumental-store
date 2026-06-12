@extends('layouts.app')

@section('content')

<style>
    .verify-container {
        max-width: 600px;
        margin: 60px auto;
        padding: 40px 30px;
        text-align: center;
        background: #ffffff;
        border-radius: 8px;
        border: 1px solid #eaeaea;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    .verify-title {
        color: #a60a33;
        margin-bottom: 20px;
    }

    .verify-text-main {
        font-size: 1.05rem;
        color: #444;
        line-height: 1.6;
    }

    .verify-text-sub {
        font-size: 0.95rem;
        color: #666;
        margin-bottom: 30px;
    }

    .verify-alert {
        color: #155724;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        padding: 12px;
        margin: 20px 0;
        border-radius: 4px;
        font-weight: bold;
    }

    .verify-btn {
        background: #a60a33;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 4px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .verify-btn:hover {
        background: #8a0729;
    }
</style>

<div class="verify-container">
    <h2 class="verify-title">Verifique o seu E-mail</h2>
    
    <p class="verify-text-main">
        Obrigado por se cadastrar na nossa loja! Antes de começar, enviámos um link de confirmação para o seu e-mail.
    </p>
    
    <p class="verify-text-sub">
        Por favor, verifique sua caixa de entrada e clique no link para validar a sua conta.
    </p>

    @if (session('message'))
        <div class="verify-alert">
            {{ session('message') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="verify-btn">
            Reenviar e-mail de verificação
        </button>
    </form>
</div>

@endsection