@extends('layouts.admin')

@section('breadcrumb', __('messages.payments'))

@section('content')
<div class="admin-page-header">
    <h2>{{ __('messages.payments') }}</h2>
</div>

<div class="metrics-grid">
    <div class="metric-card">
        <h3 class="metric-title">Receita total</h3>
        <p class="metric-value">R$ {{ number_format($receitaTotal, 2, ',', '.') }}</p>
        <p style="font-size: 13px; color: #888; margin: 0; margin-top: auto;">Ultimos 7 dias</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">Transações concluídas</h3>
        <p class="metric-value">{{ $transacoesConcluidas }}</p>
        <p style="font-size: 13px; color: #888; margin: 0; margin-top: auto;">Ultimos 7 dias</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">Transações pendentes</h3>
        <p class="metric-value">{{ $transacoesPendentes }}</p>
        <p style="font-size: 13px; color: #888; margin: 0; margin-top: auto;">Ultimos 7 dias</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">Transações com falha</h3>
        <p class="metric-value">{{ $transacoesFalha }}</p>
        <p style="font-size: 13px; color: #888; margin: 0; margin-top: auto;">Ultimos 7 dias</p>
    </div>
</div>

<div class="table-container">
    <div class="table-controls">
        <div class="table-tabs">
            <button class="tab {{ request('status') == '' ? 'active' : '' }}" data-status="">Todos pedidos ({{ $totalPagamentos }})</button>
            <button class="tab {{ request('status') == 'aprovado' ? 'active' : '' }}" data-status="aprovado">Finalizados</button>
            <button class="tab {{ request('status') == 'pendente' ? 'active' : '' }}" data-status="pendente">Pendentes</button>
            <button class="tab {{ request('status') == 'recusado' ? 'active' : '' }}" data-status="recusado">Cancelados</button>
        </div>
        
        <div class="table-actions">
            <div class="search-box">
                <input type="text" id="input-pesquisa-pagamentos" value="{{ request('search') }}" placeholder="pesquisar">
                <span class="material-symbols-outlined">search</span>
            </div>
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Id do cliente</th>
                <th>Nome</th>
                <th>Data</th>
                <th>Total</th>
                <th>Método</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pagamentos as $pagamento)
                @php
                    $statusClasse = 'pendente';
                    $statusTexto = 'Pendente';
                    if($pagamento->status == 'aprovado') {
                        $statusClasse = 'entregue';
                        $statusTexto = 'Finalizado';
                    } elseif($pagamento->status == 'recusado') {
                        $statusClasse = 'cancelado';
                        $statusTexto = 'Cancelado';
                    }
                @endphp
                <tr>
                    <td style="font-weight: 600;">#{{ $pagamento->pedido->codigo ?? 'N/A' }}</td>
                    <td>{{ $pagamento->pedido->cliente_nome ?? 'Desconhecido' }}</td>
                    <td>{{ $pagamento->created_at->format('d/m/Y') }}</td>
                    <td style="font-weight: 600; color: #b0003a;">R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</td>
                    <td>{{ ucfirst($pagamento->metodo) }}</td>
                    <td>
                        <span class="status-badge status-{{ $statusClasse }}">
                            {{ $statusTexto }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem;">Nenhum pagamento encontrado.</td>
                </tr>
            @endforelse 
        </tbody>
    </table>
</div>

<script src="{{ asset('js/filtros-pagamentos.js') }}"></script>
@endsection