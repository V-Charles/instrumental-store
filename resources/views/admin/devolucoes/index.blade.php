@extends('layouts.admin')

@section('breadcrumb', 'Devoluções')

@section('content')
<div class="admin-page-header">
    <h2>Devoluções</h2>
</div>

<div class="metrics-grid">
    <div class="metric-card">
        <h3 class="metric-title">Total devoluções</h3>
        <p class="metric-value">{{ $totalDevolucoes }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">Novas solicitações</h3>
        <p class="metric-value">{{ $novasDevolucoes }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">Em inspeção</h3>
        <p class="metric-value">{{ $emInspecao }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">Reembolsadas</h3>
        <p class="metric-value">{{ $reembolsadas }}</p>
    </div>
</div>

<div class="table-container">
    <div class="table-controls">
        <div class="table-tabs">
            <button class="tab {{ request('status') == '' ? 'active' : '' }}" data-status="">Todos pedidos ({{ $totalDevolucoes }})</button>
            <button class="tab {{ request('status') == 'solicitado' ? 'active' : '' }}" data-status="solicitado">Solicitado</button>
            <button class="tab {{ request('status') == 'inspecao' ? 'active' : '' }}" data-status="inspecao">Em Inspeção</button>
            <button class="tab {{ request('status') == 'reembolsado' ? 'active' : '' }}" data-status="reembolsado">Finalizados</button>
        </div>
        
        <div class="table-actions">
            <div class="search-box">
                <input type="text" id="input-pesquisa-devolucoes" value="{{ request('search') }}" placeholder="pesquisar">
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
                <th>Motivo</th>
                <th>Status</th>
                <th>Ação</th>
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
                    $statusTexto = match($devolucao->status) {
                        'solicitado' => 'Solicitado',
                        'aguardando_envio' => 'Aguardando Envio',
                        'inspecao' => 'Em Inspeção',
                        'reembolsado' => 'Reembolsado',
                        'recusado' => 'Recusado',
                        default => ucfirst($devolucao->status)
                    };
                @endphp
                <tr>
                    <td style="font-weight: 600;">#{{ $devolucao->pedido->codigo ?? 'N/A' }}</td>
                    <td>{{ $devolucao->pedido->cliente_nome ?? 'Desconhecido' }}</td>
                    <td>{{ $devolucao->created_at->format('d/m/Y') }}</td>
                    <td style="font-weight: 600; color: #b0003a;">R$ {{ number_format($devolucao->valor_reembolso, 2, ',', '.') }}</td>
                    <td>{{ $devolucao->motivo }}</td>
                    <td>
                        <span class="status-badge status-{{ $statusClasse }}">
                            {{ $statusTexto }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="/admin/devolucoes/{{ $devolucao->id }}" title="Ver Detalhes"><span class="material-symbols-outlined">visibility</span></a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 2rem;">Nenhuma devolução encontrada.</td>
                </tr>
            @endforelse 
        </tbody>
    </table>
</div>

<script src="{{ asset('js/filtros-devolucoes.js') }}"></script>
@endsection