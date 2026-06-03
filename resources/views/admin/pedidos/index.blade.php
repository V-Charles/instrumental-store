@extends('layouts.admin')

@section('breadcrumb', __('messages.admin_orders'))

@section('content')
<div class="admin-page-header">
    <h2>{{ __('messages.admin_orders') }}</h2>
</div>

<div class="metrics-grid">
    <div class="metric-card">
        <h3 class="metric-title">Total de pedidos</h3>
        <p class="metric-value">{{ $totalPedidos }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">Novos pedidos</h3>
        <p class="metric-value">{{ $novosPedidos }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">Pedidos finalizados</h3>
        <p class="metric-value">{{ $pedidosFinalizados }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">Pedidos cancelados</h3>
        <p class="metric-value">{{ $pedidosCancelados }}</p>
    </div>
</div>

<div class="table-container">
    <div class="table-controls">
        <div class="table-tabs">
            <button class="tab {{ request('status') == '' ? 'active' : '' }}" data-status="">Todos os Pedidos ({{ $totalPedidos }})</button>
            <button class="tab {{ request('status') == 'pendente' ? 'active' : '' }}" data-status="pendente">Pendentes</button>
            <button class="tab {{ request('status') == 'enviado' ? 'active' : '' }}" data-status="enviado">Enviados</button>
            <button class="tab {{ request('status') == 'entregue' ? 'active' : '' }}" data-status="entregue">Entregues</button>
            <button class="tab {{ request('status') == 'cancelado' ? 'active' : '' }}" data-status="cancelado">Cancelados</button>
        </div>
        
        <div class="table-actions">
            <div class="search-box">
                <input type="text" id="input-pesquisa-pedidos" value="{{ request('search') }}" placeholder="Buscar por cliente ou código">
                <span class="material-symbols-outlined">search</span>
            </div>
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Cliente</th>
                <th>Data da Compra</th>
                <th>Total</th>
                <th>Status</th>
                <th>Ação</th>
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
                            {{ ucfirst($pedido->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="/admin/pedidos/{{ $pedido->id }}" title="Ver Detalhes"><span class="material-symbols-outlined">visibility</span></a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem;">Nenhum pedido encontrado com estes filtros.</td>
                </tr>
            @endforelse 
        </tbody>
    </table>
</div>

<script src="{{ asset('js/filtros-pedidos.js') }}"></script>
@endsection