@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Meu Carrinho</h1>

    @forelse($cart as $item)

        <div>

            <h3>{{ $item['nome'] }}</h3>

            <div style="display:flex; gap:10px; align-items:center;">

                <form action="{{ route('cart.decrease', $item['id']) }}"
                      method="POST">
                    @csrf
                    <button type="submit">-</button>
                </form>

                <strong>
                    {{ $item['quantidade'] }}
                </strong>

                <form action="{{ route('cart.increase', $item['id']) }}"
                      method="POST">
                    @csrf
                    <button type="submit">+</button>
                </form>

            </div>

            <p>
                Preço Unitário:
                R$ {{ number_format($item['preco'], 2, ',', '.') }}
            </p>

            <p>
                Subtotal:
                R$ {{ number_format($item['preco'] * $item['quantidade'], 2, ',', '.') }}
            </p>

            <form action="{{ route('cart.remove', $item['id']) }}"
                  method="POST">

                @csrf

                <button type="submit">
                    Remover
                </button>

            </form>

        </div>

        <hr>

    @empty

        <p>Carrinho vazio.</p>

    @endforelse

    @if(count($cart) > 0)

        <h2>
            Total do Carrinho:
            R$ {{ number_format($total, 2, ',', '.') }}
        </h2>

        <form action="{{ route('cart.checkout') }}"
          method="POST">

        @csrf

        <div>

            <label>
                Forma de pagamento
            </label>

            <select name="forma_pagamento" required>

                <option value="">
                    Selecione
                </option>

                <option value="credito">
                    Cartão de Crédito
                </option>

                <option value="debito">
                    Cartão de Débito
                </option>

    </select>

        </div>

        <button type="submit">
            Finalizar Compra
        </button>

    </form>

@endif

</div>

@endsection