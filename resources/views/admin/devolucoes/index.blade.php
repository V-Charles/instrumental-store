@extends('layouts.admin')

@section('breadcrumb', __('messages.returns'))

@section('content')
<div class="admin-page-header">
    <h2>{{ __('messages.returns') }}</h2>
</div>

<div class="metrics-grid">
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.total_returns') }}</h3>
        <p class="metric-value">{{ $totalDevolucoes }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.new_requests') }}</h3>
        <p class="metric-value">{{ $novasDevolucoes }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.under_inspection') }}</h3>
        <p class="metric-value">{{ $emInspecao }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.refunded') }}</h3>
        <p class="metric-value">{{ $reembolsadas }}</p>
    </div>
</div>

<div class="table-container">
    <div class="table-controls">
        <div class="table-tabs">
            <button class="tab {{ request('status') == '' ? 'active' : '' }}" data-status="">{{ __('messages.all_orders_count', ['total' => $totalDevolucoes]) }}</button>
            <button class="tab {{ request('status') == 'solicitado' ? 'active' : '' }}" data-status="solicitado">{{ __('messages.status_solicitado') }}</button>
            <button class="tab {{ request('status') == 'inspecao' ? 'active' : '' }}" data-status="inspecao">{{ __('messages.status_inspecao') }}</button>
            <button class="tab {{ request('status') == 'reembolsado' ? 'active' : '' }}" data-status="reembolsado">{{ __('messages.completed_plural') }}</button>
        </div>
        
        <div class="table-actions">
            <div class="search-box">
                <input type="text" id="input-pesquisa-devolucoes" value="{{ request('search') }}" placeholder="{{ __('messages.search_placeholder') }}">
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
                <th>{{ __('messages.reason_column') }}</th>
                <th>{{ __('messages.status_column') }}</th>
                <th>{{ __('messages.action_column') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($devolucoes as $devolucao)
                @php
                    $statusClasse = match($devolucao->status) {
                        'solicitado' => 'pendente',
                        'aguardando_envio' => 'enviado',
                        'inspecao' => 'default',
                        'reembolsado' => 'entregue',
                        'recusado' => 'cancelado',
                        default => 'default'
                    };
                @endphp
                <tr>
                    <td style="font-weight: 600;">#{{ $devolucao->pedido->codigo ?? 'N/A' }}</td>
                    <td>{{ $devolucao->pedido->cliente_nome ?? __('messages.unknown_customer') }}</td>
                    <td>{{ $devolucao->created_at->format('d/m/Y') }}</td>
                    <td style="font-weight: 600; color: #b0003a;">R$ {{ number_format($devolucao->valor_reembolso, 2, ',', '.') }}</td>
                    <td>{{ $devolucao->motivo }}</td>
                    <td>
                        <span class="status-badge status-{{ $statusClasse }}">
                            {{ __('messages.return_status_' . ($devolucao->status ?? 'solicitado')) }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="/admin/devolucoes/{{ $devolucao->id }}" title="{{ __('messages.view_details_title') }}"><span class="material-symbols-outlined">visibility</span></a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 2rem;">{{ __('messages.no_returns_found') }}</td>
                </tr>
            @endforelse 
        </tbody>
    </table>
</div>

<script src="{{ asset('js/filtros-devolucoes.js') }}"></script>
@endsection