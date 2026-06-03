@extends('layouts.admin')

@section('breadcrumb', 'Dashboard')

@section('content')
<div class="admin-page-header">
    <h2>Dashboard</h2>
</div>

<div class="dashboard-grid-top">
    <div class="dash-card">
        <div class="dash-card-header">
            <div>
                <h3 class="dash-card-title">Total de vendas</h3>
                <p class="dash-card-subtitle">Últimos 7 dias</p>
            </div>
            <span class="material-symbols-outlined" style="color: #888; cursor: pointer;">more_vert</span>
        </div>
        
        <div class="dash-value-large" style="margin-bottom: 32px;">
            R$ {{ number_format($receitaSemana / 1000, 1, ',', '.') }}K
            <span class="dash-trend-up"><span class="material-symbols-outlined" style="font-size: 16px;">arrow_upward</span> 10.4%</span>
        </div>
        
        <a href="/admin/pagamentos" class="btn-outline-red">Detalhes</a>
    </div>

    <div class="dash-card">
        <div class="dash-card-header">
            <h3 class="dash-card-title">Relatório desta semana</h3>
            <div style="display: flex; gap: 12px; align-items: center;">
                <span id="btn-semana-atual" style="color: #b0003a; font-size: 13px; font-weight: 600; cursor: pointer;">Essa semana</span>
                <span id="btn-semana-anterior" style="color: #888; font-size: 13px; font-weight: 600; cursor: pointer;">Última semana</span>
                <span class="material-symbols-outlined" style="color: #b0003a; cursor: pointer;">more_vert</span>
            </div>
        </div>

        <div class="chart-stats-row">
            <div class="chart-stat-item active">
                <span class="chart-stat-value">{{ number_format($totalClientes / 1000, 1, '.', '') }}k</span>
                <span class="chart-stat-label">Clientes</span>
            </div>
            <div class="chart-stat-item">
                <span class="chart-stat-value">{{ number_format($totalProdutos / 1000, 1, '.', '') }}k</span>
                <span class="chart-stat-label">Total Produtos</span>
            </div>
            <div class="chart-stat-item">
                <span class="chart-stat-value">{{ number_format($produtosEmEstoque / 1000, 1, '.', '') }}k</span>
                <span class="chart-stat-label">Produtos em estoque</span>
            </div>
            <div class="chart-stat-item">
                <span class="chart-stat-value">{{ number_format($produtosForaEstoque / 1000, 1, '.', '') }}k</span>
                <span class="chart-stat-label">Fora de estoque</span>
            </div>
            <div class="chart-stat-item">
                <span class="chart-stat-value">{{ number_format($receitaTotal / 1000, 0, '', '') }}k</span>
                <span class="chart-stat-label">Receita</span>
            </div>
        </div>

        <div class="chart-container-wrapper">
            <canvas id="dashboardChart"></canvas>
        </div>
    </div>
</div>

<div style="display: flex; align-items: baseline; gap: 24px; margin-bottom: 16px;">
    <div>
        <h3 style="margin: 0; font-size: 16px; font-weight: 700; color: #333;">Total de pedidos</h3>
        <p style="margin: 4px 0 0 0; font-size: 28px; font-weight: 800; color: #10332d;">{{ number_format($totalPedidos, 0, ',', '.') }}</p>
    </div>
    <div style="display: flex; gap: 16px; background: #fbf5ee; padding: 6px 16px; border-radius: 6px;">
        <span class="tab-dash active" data-status="" style="font-size: 13px; font-weight: 600; color: #b0003a; cursor: pointer;">Todos</span>
        <span class="tab-dash" data-status="pendente" style="font-size: 13px; font-weight: 600; color: #888; cursor: pointer;">Pendente</span>
        <span class="tab-dash" data-status="cancelado" style="font-size: 13px; font-weight: 600; color: #888; cursor: pointer;">Cancelada</span>
    </div>
    <div class="search-box" style="margin-left: auto;">
        <input type="text" id="input-pesquisa-dash" placeholder="pesquisar">
        <span class="material-symbols-outlined">search</span>
    </div>
</div>

<div class="table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID do pedido</th>
                <th>Data</th>
                <th>Preço</th>
                <th>Pagamento</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="tbody-pedidos-dash">
            @foreach($ultimosPedidos as $index => $pedido)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="font-weight: 600;">#{{ $pedido->codigo }}</td>
                    <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                    <td style="font-weight: 600;">R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                    <td>
                        @if($pedido->pagamento && $pedido->pagamento->status == 'aprovado')
                            <span class="status-dot dot-pago"></span> Pago
                        @else
                            <span class="status-dot dot-nao-pago"></span> Não pago
                        @endif
                    </td>
                    <td>
                        <span class="status-badge status-{{ strtolower($pedido->status) }}">
                            {{ ucfirst($pedido->status) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartLabels = @json($labelsGrafico);
    const dadosSemanaAtual = @json($dadosSemanaAtual);
    const dadosSemanaAnterior = @json($dadosSemanaAnterior);
</script>
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection