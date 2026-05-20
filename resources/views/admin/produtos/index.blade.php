@extends('layouts.admin')

@section('breadcrumb', 'PRODUTOS')

@section('content')
<div class="admin-page-header">
    <h2>Produtos</h2>
    <a href="/admin/produtos/create" class="btn-primary">
        <span class="material-symbols-outlined">add_circle</span>
        Adicionar produto
    </a>
</div>

<div class="categories-grid">
    <button class="category-card">Acessórios</button>
    <button class="category-card">Cordas</button>
    <button class="category-card">Amplificadores</button>
    <button class="category-card">Pedais & Pedaleiras</button>
    <button class="category-card">Percussão</button>
    <button class="category-card">Áudio e Tecnologia</button>
    <button class="category-card">Sopro</button>
    <button class="category-card">Teclas</button>
</div>

<div class="table-container">
    
    <div class="table-controls">
        <div class="table-tabs">
            <button class="tab active">Todos Produtos ({{ $totalProdutos }})</button>
            <button class="tab">Produtos em destaque</button>
            <button class="tab">À venda</button>
            <button class="tab">Fora de estoque</button>
        </div>
        
        <div class="table-actions">
            <div class="search-box">
                <input type="text" placeholder="pesquisar">
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
                    <td>{{ $produto->created_at->format('d-m-Y') }}</td>
                    <td>0</td>
                    <td>
                        <div class="action-buttons">
                            <a href="/admin/produtos/{{ $produto->id }}/edit"><span class="material-symbols-outlined">edit</span></a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Nenhum produto cadastrado.</td>
                </tr>
            @endforelse 
        </tbody>
    </table>
</div>
@endsection