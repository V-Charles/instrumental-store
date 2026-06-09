@extends('layouts.admin')

@section('breadcrumb', __('messages.clients'))

@section('content')
<div class="admin-page-header">
    <h2>{{ __('messages.clients') }}</h2>
</div>

<div class="metrics-grid">
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.total_clients') }}</h3>
        <p class="metric-value">{{ $totalClientes }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.new_clients') }}</h3>
        <p class="metric-value">{{ $novosClientes }}</p>
        <p style="font-size: 13px; color: #888; margin: 0; margin-top: auto;">{{ __('messages.last_30_days') }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.male_audience') }}</h3>
        <p class="metric-value">{{ $clientesMasculino }}</p>
    </div>
    <div class="metric-card">
        <h3 class="metric-title">{{ __('messages.female_audience') }}</h3>
        <p class="metric-value">{{ $clientesFeminino }}</p>
    </div>
</div>

<div class="table-container">
    <div class="table-controls">
        <div class="table-tabs">
            <button class="tab {{ request('sexo') == '' ? 'active' : '' }}" data-sexo="">{{ __('messages.all_count', ['total' => $totalClientes]) }}</button>
            <button class="tab {{ request('sexo') == 'masculino' ? 'active' : '' }}" data-sexo="masculino">{{ __('messages.gender_masculino') }}</button>
            <button class="tab {{ request('sexo') == 'feminino' ? 'active' : '' }}" data-sexo="feminino">{{ __('messages.gender_feminino') }}</button>
            <button class="tab {{ request('sexo') == 'outro' ? 'active' : '' }}" data-sexo="outro">{{ __('messages.gender_outro') }}</button>
        </div>
        
        <div class="table-actions">
            <div class="search-box">
                <input type="text" id="input-pesquisa-clientes" value="{{ request('search') }}" placeholder="{{ __('messages.search_clients_placeholder') }}">
                <span class="material-symbols-outlined">search</span>
            </div>
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>{{ __('messages.name_column') }}</th>
                <th>{{ __('messages.email_column') }}</th>
                <th>{{ __('messages.cpf_column') }}</th>
                <th>{{ __('messages.phone_column') }}</th>
                <th>{{ __('messages.gender_column') }}</th>
                <th>{{ __('messages.registration_date_column') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clientes as $cliente)
                <tr>
                    <td style="font-weight: 600;">{{ $cliente->nome }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->cpf ?? __('messages.not_informed') }}</td>
                    <td>{{ $cliente->telefone ?? __('messages.not_informed') }}</td>
                    <td>{{ __('messages.gender_' . ($cliente->sexo ?? 'outro')) }}</td>
                    <td>{{ $cliente->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem;">{{ __('messages.no_clients_found') }}</td>
                </tr>
            @endforelse 
        </tbody>
    </table>
</div>

<script src="{{ asset('js/filtros-clientes.js') }}"></script>
@endsection