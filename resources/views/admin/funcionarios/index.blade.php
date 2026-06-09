@extends('layouts.admin')

@section('breadcrumb', __('messages.team'))

@section('content')
<div class="admin-page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <h2>{{ __('messages.team_and_access') }}</h2>
    <a href="/admin/funcionarios/criar" class="btn-action btn-primary" style="text-decoration: none;">{{ __('messages.new_employee') }}</a>
</div>

@if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 20px; font-weight: 600; font-size: 14px; border: 1px solid #c3e6cb;">
        {{ session('success') }}
    </div>
@endif

<div class="metrics-grid">
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.total_team') }}</h3>
        <p class="metric-value">{{ $totalFuncionarios }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.role_admins') }}</h3>
        <p class="metric-value">{{ $totalAdmins }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.role_managers') }}</h3>
        <p class="metric-value">{{ $totalGerentes }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.role_operators') }}</h3>
        <p class="metric-value">{{ $totalOperadores }}</p>
    </div>
</div>

<div class="table-container">
    <div class="table-controls">
        <div class="table-tabs">
            <button class="tab {{ request('cargo') == '' ? 'active' : '' }}" data-cargo="">{{ __('messages.all_count', ['total' => $totalFuncionarios]) }}</button>
            <button class="tab {{ request('cargo') == 'admin' ? 'active' : '' }}" data-cargo="admin">{{ __('messages.role_admins') }}</button>
            <button class="tab {{ request('cargo') == 'gerente' ? 'active' : '' }}" data-cargo="gerente">{{ __('messages.role_managers') }}</button>
            <button class="tab {{ request('cargo') == 'operador' ? 'active' : '' }}" data-cargo="operador">{{ __('messages.role_operators') }}</button>
        </div>
        
        <div class="table-actions">
            <div class="search-box">
                <input type="text" id="input-pesquisa-funcionarios" value="{{ request('search') }}" placeholder="{{ __('messages.search_team_placeholder') }}">
                <span class="material-symbols-outlined">search</span>
            </div>
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>{{ __('messages.name_column') }}</th>
                <th>{{ __('messages.email_column') }}</th>
                <th>{{ __('messages.role_column') }}</th>
                <th>{{ __('messages.status_column') }}</th>
                <th>{{ __('messages.registration_date_column') }}</th>
                <th>{{ __('messages.action_column') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($funcionarios as $funcionario)
                @php
                    $statusClasse = $funcionario->ativo ? 'entregue' : 'cancelado';
                    $statusChave = $funcionario->ativo ? 'active' : 'inactive';
                @endphp
                <tr>
                    <td style="font-weight: 600;">{{ $funcionario->name }}</td>
                    <td>{{ $funcionario->email }}</td>
                    <td>{{ __('messages.role_' . strtolower($funcionario->cargo)) }}</td>
                    <td>
                        <span class="status-badge status-{{ $statusClasse }}">
                            {{ __('messages.status_' . $statusChave) }}
                        </span>
                    </td>
                    <td>{{ $funcionario->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="/admin/funcionarios/{{ $funcionario->id }}/editar" title="{{ __('messages.edit_product') }}"><span class="material-symbols-outlined">edit</span></a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem;">{{ __('messages.no_team_found') }}</td>
                </tr>
            @endforelse 
        </tbody>
    </table>
</div>

<script src="{{ asset('js/filtros-funcionarios.js') }}"></script>
@endsection