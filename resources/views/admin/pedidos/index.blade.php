@extends('layouts.admin')

@section('breadcrumb', __('messages.admin_orders'))

@section('content')
<div class="admin-page-header">
    <h2>{{ __('messages.admin_orders') }}</h2>
</div>

<div class="metrics-grid">
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.total_orders') }}</h3>
        <p class="metric-value">{{ $totalPedidos }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.new_orders') }}</h3>
        <p class="metric-value">{{ $novosPedidos }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.completed_orders') }}</h3>
        <p class="metric-value">{{ $pedidosFinalizados }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.canceled_orders') }}</h3>
        <p class="metric-value">{{ $pedidosCancelados }}</p>
    </div>
</div>

<div class="table-container">
    <div class="table-controls">
        <div class="table-tabs">
            <button class="tab {{ request('status') == '' ? 'active' : '' }}" data-status="">{{ __('messages.all_orders_count', ['total' => $totalPedidos]) }}</button>
            <button class="tab {{ request('status') == 'pendente' ? 'active' : '' }}" data-status="pendente">{{ __('messages.pending_plural') }}</button>
            <button class="tab {{ request('status') == 'enviado' ? 'active' : '' }}" data-status="enviado">{{ __('messages.shipped_plural') }}</button>
            <button class="tab {{ request('status') == 'entregue' ? 'active' : '' }}" data-status="entregue">{{ __('messages.delivered_plural') }}</button>
            <button class="tab {{ request('status') == 'cancelado' ? 'active' : '' }}" data-status="cancelado">{{ __('messages.canceled_plural') }}</button>
        </div>
        
        <div class="table-actions">
            <div class="search-box">
                <input type="text" id="input-pesquisa-pedidos" value="{{ request('search') }}" placeholder="{{ __('messages.search_orders_placeholder') }}">
                <span class="material-symbols-outlined">search</span>
            </div>
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>{{ __('messages.code_column') }}</th>
                <th>{{ __('messages.client_column') }}</th>
                <th>{{ __('messages.purchase_date_column') }}</th>
                <th>{{ __('messages.total_column') }}</th>
                <th>{{ __('messages.status_column') }}</th>
                <th>{{ __('messages.action_column') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pedidos as $pedido)
                <tr>
                    <td style="font-weight: 600;">#{{ $pedido->codigo }}</td>
                    <td>
                        {{ $pedido->cliente_nome }}<br>
                        <small style="color: #888;">{{ $pedido->cliente_email }}</small>
                    </td>
                    <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                    <td style="font-weight: 600; color: #b0003a;">R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                    <td>
                        <span class="status-badge status-{{ strtolower($pedido->status) }}">
                            {{ __('messages.status_' . strtolower($pedido->status)) }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="/admin/pedidos/{{ $pedido->id }}" title="{{ __('messages.view_details_title') }}"><span class="material-symbols-outlined">visibility</span></a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem;">{{ __('messages.no_orders_found') }}</td>
                </tr>
            @endforelse 
        </tbody>
    </table>
</div>

<script src="{{ asset('js/filtros-pedidos.js') }}"></script>
@endsection