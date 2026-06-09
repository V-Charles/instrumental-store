@extends('layouts.admin')

@section('breadcrumb', __('messages.payments'))

@section('content')
<div class="admin-page-header">
    <h2>{{ __('messages.payments') }}</h2>
</div>

<div class="metrics-grid">
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.total_revenue') }}</h3>
        <p class="metric-value">R$ {{ number_format($receitaTotal, 2, ',', '.') }}</p>
        <p style="font-size: 13px; color: #888; margin: 0; margin-top: auto;">{{ __('messages.last_7_days') }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.completed_transactions') }}</h3>
        <p class="metric-value">{{ $transacoesConcluidas }}</p>
        <p style="font-size: 13px; color: #888; margin: 0; margin-top: auto;">{{ __('messages.last_7_days') }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.pending_transactions') }}</h3>
        <p class="metric-value">{{ $transacoesPendentes }}</p>
        <p style="font-size: 13px; color: #888; margin: 0; margin-top: auto;">{{ __('messages.last_7_days') }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.failed_transactions') }}</h3>
        <p class="metric-value">{{ $transacoesFalha }}</p>
        <p style="font-size: 13px; color: #888; margin: 0; margin-top: auto;">{{ __('messages.last_7_days') }}</p>
    </div>
</div>

<div class="table-container">
    <div class="table-controls">
        <div class="table-tabs">
            <button class="tab {{ request('status') == '' ? 'active' : '' }}" data-status="">{{ __('messages.all_orders_count', ['total' => $totalPagamentos]) }}</button>
            <button class="tab {{ request('status') == 'aprovado' ? 'active' : '' }}" data-status="aprovado">{{ __('messages.completed_plural') }}</button>
            <button class="tab {{ request('status') == 'pendente' ? 'active' : '' }}" data-status="pendente">{{ __('messages.pending_plural') }}</button>
            <button class="tab {{ request('status') == 'recusado' ? 'active' : '' }}" data-status="recusado">{{ __('messages.canceled_plural') }}</button>
        </div>
        
        <div class="table-actions">
            <div class="search-box">
                <input type="text" id="input-pesquisa-pagamentos" value="{{ request('search') }}" placeholder="{{ __('messages.search_placeholder') }}">
                <span class="material-symbols-outlined">search</span>
            </div>
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>{{ __('messages.customer_id_column') }}</th>
                <th>{{ __('messages.name_column') }}</th>
                <th>{{ __('messages.date_column') }}</th>
                <th>{{ __('messages.total_column') }}</th>
                <th>{{ __('messages.method_column') }}</th>
                <th>{{ __('messages.status_column') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pagamentos as $pagamento)
                @php
                    $statusClasse = 'pendente';
                    if($pagamento->status == 'aprovado') {
                        $statusClasse = 'entregue';
                    } elseif($pagamento->status == 'recusado') {
                        $statusClasse = 'cancelado';
                    }
                @endphp
                <tr>
                    <td style="font-weight: 600;">#{{ $pagamento->pedido->codigo ?? 'N/A' }}</td>
                    <td>{{ $pagamento->pedido->cliente_nome ?? __('messages.unknown_customer') }}</td>
                    <td>{{ $pagamento->created_at->format('d/m/Y') }}</td>
                    <td style="font-weight: 600; color: #b0003a;">R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</td>
                    <td>{{ ucfirst($pagamento->metodo) }}</td>
                    <td>
                        <span class="status-badge status-{{ $statusClasse }}">
                            {{ __('messages.payment_status_' . ($pagamento->status ?? 'pendente')) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem;">{{ __('messages.no_payments_found') }}</td>
                </tr>
            @endforelse 
        </tbody>
    </table>
</div>

<script src="{{ asset('js/filtros-pagamentos.js') }}"></script>
@endsection