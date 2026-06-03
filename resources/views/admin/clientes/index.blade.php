@extends('layouts.admin')

@section('breadcrumb', 'Clientes')

@section('content')
<div class="admin-page-header">
    <h2>Clientes</h2>
</div>

<div class="metrics-grid">
    <div class="metric-card">
        <h3 class="metric-title">Total de clientes</h3>
        <p class="metric-value">{{ $totalClientes }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">Novos clientes</h3>
        <p class="metric-value">{{ $novosClientes }}</p>
        <p style="font-size: 13px; color: #888; margin: 0; margin-top: auto;">Últimos 30 dias</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">Público Masculino</h3>
        <p class="metric-value">{{ $clientesMasculino }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">Público Feminino</h3>
        <p class="metric-value">{{ $clientesFeminino }}</p>
    </div>
</div>

<div class="table-container">
    <div class="table-controls">
        <div class="table-tabs">
            <button class="tab {{ request('sexo') == '' ? 'active' : '' }}" data-sexo="">Todos ({{ $totalClientes }})</button>
            <button class="tab {{ request('sexo') == 'masculino' ? 'active' : '' }}" data-sexo="masculino">Masculino</button>
            <button class="tab {{ request('sexo') == 'feminino' ? 'active' : '' }}" data-sexo="feminino">Feminino</button>
            <button class="tab {{ request('sexo') == 'outro' ? 'active' : '' }}" data-sexo="outro">Outros</button>
        </div>
        
        <div class="table-actions">
            <div class="search-box">
                <input type="text" id="input-pesquisa-clientes" value="{{ request('search') }}" placeholder="Buscar por nome, email ou CPF">
                <span class="material-symbols-outlined">search</span>
            </div>
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Sexo</th>
                <th>Data de Cadastro</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clientes as $cliente)
                <tr>
                    <td style="font-weight: 600;">{{ $cliente->nome }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->cpf ?? 'Não informado' }}</td>
                    <td>{{ $cliente->telefone ?? 'Não informado' }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $cliente->sexo)) }}</td>
                    <td>{{ $cliente->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem;">Nenhum cliente encontrado.</td>
                </tr>
            @endforelse 
        </tbody>
    </table>
</div>

<script src="{{ asset('js/filtros-clientes.js') }}"></script>
@endsection