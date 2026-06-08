@extends('layouts.admin')

@section('breadcrumb', 'Funcionários')

@section('content')
<div class="admin-page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <h2>Equipe e Acessos</h2>
    <a href="/admin/funcionarios/criar" class="btn-action btn-primary" style="text-decoration: none;">Novo Funcionário</a>
</div>

@if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 20px; font-weight: 600; font-size: 14px; border: 1px solid #c3e6cb;">
        {{ session('success') }}
    </div>
@endif

<div class="metrics-grid">
    <div class="metric-card">
        <h3 class="metric-title">Total da Equipe</h3>
        <p class="metric-value">{{ $totalFuncionarios }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">Administradores</h3>
        <p class="metric-value">{{ $totalAdmins }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">Gerentes</h3>
        <p class="metric-value">{{ $totalGerentes }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">Operadores</h3>
        <p class="metric-value">{{ $totalOperadores }}</p>
    </div>
</div>

<div class="table-container">
    <div class="table-controls">
        <div class="table-tabs">
            <button class="tab {{ request('cargo') == '' ? 'active' : '' }}" data-cargo="">Todos ({{ $totalFuncionarios }})</button>
            <button class="tab {{ request('cargo') == 'admin' ? 'active' : '' }}" data-cargo="admin">Admins</button>
            <button class="tab {{ request('cargo') == 'gerente' ? 'active' : '' }}" data-cargo="gerente">Gerentes</button>
            <button class="tab {{ request('cargo') == 'operador' ? 'active' : '' }}" data-cargo="operador">Operadores</button>
        </div>
        
        <div class="table-actions">
            <div class="search-box">
                <input type="text" id="input-pesquisa-funcionarios" value="{{ request('search') }}" placeholder="pesquisar nome ou e-mail">
                <span class="material-symbols-outlined">search</span>
            </div>
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Cargo</th>
                <th>Status</th>
                <th>Data de Cadastro</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @forelse($funcionarios as $funcionario)
                @php
                    $statusClasse = $funcionario->ativo ? 'entregue' : 'cancelado';
                    $statusTexto = $funcionario->ativo ? 'Ativo' : 'Inativo';
                @endphp
                <tr>
                    <td style="font-weight: 600;">{{ $funcionario->name }}</td>
                    <td>{{ $funcionario->email }}</td>
                    <td>{{ ucfirst($funcionario->cargo) }}</td>
                    <td>
                        <span class="status-badge status-{{ $statusClasse }}">
                            {{ $statusTexto }}
                        </span>
                    </td>
                    <td>{{ $funcionario->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="#" title="Editar"><span class="material-symbols-outlined">edit</span></a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 2rem;">Nenhum funcionário encontrado.</td>
                </tr>
            @endforelse 
        </tbody>
    </table>
</div>

<script src="{{ asset('js/filtros-funcionarios.js') }}"></script>
@endsection