@extends('layouts.admin')

@section('breadcrumb', __('messages.products_upper'))

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
    <h2>{{ __('messages.admin_products') }}</h2>
    <a href="/admin/produtos/create" class="btn-primary">
        <span class="material-symbols-outlined">add_circle</span>
        {{ __('messages.add_product') }}
    </a>
</div>

<div class="categories-grid">
    <button class="category-card" data-value="acessorios">{{ __('messages.cat_accessories') }}</button>
    <button class="category-card" data-value="cordas">{{ __('messages.cat_strings') }}</button>
    <button class="category-card" data-value="amplificadores">{{ __('messages.cat_amplifiers') }}</button>
    <button class="category-card" data-value="pedais">{{ __('messages.cat_pedals') }}</button>
    <button class="category-card" data-value="percussao">{{ __('messages.cat_percussion') }}</button>
    <button class="category-card" data-value="audio">{{ __('messages.cat_audio') }}</button>
    <button class="category-card" data-value="sopro">{{ __('messages.cat_wind') }}</button>
    <button class="category-card" data-value="teclas">{{ __('messages.cat_keys') }}</button>
</div>

<div class="table-container">
    
    <div class="table-controls">
        <div class="table-tabs">
            <button class="tab {{ request('status') == '' ? 'active' : '' }}" data-status="">{{ __('messages.all_products_count', ['total' => $totalProdutos]) }}</button>
            <button class="tab" data-status="destaque">{{ __('messages.featured_products') }}</button>
            <button class="tab {{ request('status') == 'em_estoque' ? 'active' : '' }}" data-status="em_estoque">{{ __('messages.on_sale') }}</button>
            <button class="tab {{ request('status') == 'fora_de_estoque' ? 'active' : '' }}" data-status="fora_de_estoque">{{ __('messages.out_of_stock') }}</button>
        </div>
        
        <div class="table-actions">
            <div class="search-box">
                <input type="text" id="input-pesquisa" value="{{ request('search') }}" placeholder="{{ __('messages.search_placeholder') }}">
                <span class="material-symbols-outlined">search</span>
            </div>
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>{{ __('messages.id_column') }}</th>
                <th>{{ __('messages.products_column') }}</th>
                <th>{{ __('messages.created_at_column') }}</th>
                <th>{{ __('messages.order_column') }}</th>
                <th>{{ __('messages.action_column') }}</th>
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
                    <td colspan="5" style="text-align: center; padding: 2rem;">{{ __('messages.no_products_found') }}</td>
                </tr>
            @endforelse 
        </tbody>
    </table>
</div>

<script src="{{ asset('js/filtros-produtos.js') }}"></script>
@endsection