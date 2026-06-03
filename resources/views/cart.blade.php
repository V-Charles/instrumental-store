@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Meu Carrinho</h1>

    @forelse($cart as $item)

        <div>

            <h3>{{ $item['nome'] }}</h3>

            <p>
                Quantidade:
                {{ $item['quantidade'] }}
            </p>

            <p>
                R$ {{ number_format($item['preco'], 2, ',', '.') }}
            </p>

        </div>

        <hr>

    @empty

        <p>Carrinho vazio.</p>

    @endforelse

</div>

@endsection