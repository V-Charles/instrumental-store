@extends('layouts.admin')

@section('breadcrumb', 'PRODUTOS')

@section('content')

<style>
    .category-card.active {
        background-color: #b0003a;
        color: #ffffff;
        border-color: #b0003a;
        font-weight: 600;
        transition: all 0.2s ease-in-out;
    }
</style>

<div class="admin-page-header">
    <h2>Produtos</h2>
    <a href="/admin/produtos/create" class="btn-primary">
        <span class="material-symbols-outlined">add_circle</span>
        Adicionar produto
    </a>
</div>

<div class="categories-grid">
    <button class="category-card" data-value="acessorios">Acessórios</button>
    <button class="category-card" data-value="cordas">Cordas</button>
    <button class="category-card" data-value="amplificadores">Amplificadores</button>
    <button class="category-card" data-value="pedais">Pedais & Pedaleiras</button>
    <button class="category-card" data-value="percussao">Percussão</button>
    <button class="category-card" data-value="audio">Áudio e Tecnologia</button>
    <button class="category-card" data-value="sopro">Sopro</button>
    <button class="category-card" data-value="teclas">Teclas</button>
</div>

<div class="table-container">
    
    <div class="table-controls">
        <div class="table-tabs">
            <button class="tab {{ request('status') == '' ? 'active' : '' }}" data-status="">Todos Produtos ({{ $totalProdutos }})</button>
            <button class="tab" data-status="destaque">Produtos em destaque</button>
            <button class="tab {{ request('status') == 'em_estoque' ? 'active' : '' }}" data-status="em_estoque">À venda</button>
            <button class="tab {{ request('status') == 'fora_de_estoque' ? 'active' : '' }}" data-status="fora_de_estoque">Fora de estoque</button>
        </div>
        
        <div class="table-actions">
            <div class="search-box">
                <input type="text" id="input-pesquisa" value="{{ request('search') }}" placeholder="pesquisar">
                <span class="material-symbols-outlined">search</span>
            </div>
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produtos</th>
                <th>Data de criação</th>
                <th>Pedido</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produtos as $produto)
                <tr>
                    <td>{{ $produto->id }}</td>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->created_at->format('d/m/Y') }}</td>
                    <td>0</td>
                    <td>
                        <div class="action-buttons">
                            <a href="/admin/produtos/{{ $produto->id }}/edit"><span class="material-symbols-outlined">edit</span></a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 2rem;">Nenhum produto encontrado com estes filtros.</td>
                </tr>
            @endforelse 
        </tbody>
    </table>
</div>

<script src="{{ asset('js/filtros-produtos.js') }}"></script>
@endsection