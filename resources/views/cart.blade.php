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

        <button type="submit">
            -
        </button>

    </form>

    <strong>
        {{ $item['quantidade'] }}
    </strong>

    <form action="{{ route('cart.increase', $item['id']) }}"
          method="POST">

        @csrf

        <button type="submit">
            +
        </button>

    </form>

</div>

        <p>
            R$ {{ number_format($item['preco'], 2, ',', '.') }}
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

</div>

@endsection