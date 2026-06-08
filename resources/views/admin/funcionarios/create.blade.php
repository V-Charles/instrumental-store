@extends('layouts.admin')

@section('breadcrumb', 'Funcionários > Cadastrar')

@section('content')
<div class="details-header">
    <a href="/admin/funcionarios" class="back-link">
        <span class="material-symbols-outlined">arrow_back</span>
        Voltar para Equipe
    </a>
</div>

<div class="details-grid" style="grid-template-columns: 1fr; max-width: 800px; margin: 0 auto;">
    <div class="details-card">
        <h3 class="details-card-title">Cadastrar Novo Funcionário</h3>
        
        @if($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 6px; margin-bottom: 20px; font-weight: 600; font-size: 14px; border: 1px solid #f5c6cb;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="/admin/funcionarios" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 20px; margin-top: 20px;">
            @csrf

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <label for="name" style="font-size: 14px; font-weight: 600; color: #333;">Nome Completo</label>
                <input type="text" id="name" name="name" required style="padding: 10px; border: 1px solid #eaeaea; border-radius: 6px; font-size: 14px;">
            </div>

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <label for="email" style="font-size: 14px; font-weight: 600; color: #333;">E-mail de Acesso</label>
                <input type="email" id="email" name="email" required style="padding: 10px; border: 1px solid #eaeaea; border-radius: 6px; font-size: 14px;">
            </div>

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <label for="password" style="font-size: 14px; font-weight: 600; color: #333;">Senha Inicial</label>
                <input type="password" id="password" name="password" required style="padding: 10px; border: 1px solid #eaeaea; border-radius: 6px; font-size: 14px;">
            </div>

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <label for="cargo" style="font-size: 14px; font-weight: 600; color: #333;">Nível de Acesso (Cargo)</label>
                <select id="cargo" name="cargo" required style="padding: 10px; border: 1px solid #eaeaea; border-radius: 6px; font-size: 14px; background-color: #fff;">
                    <option value="operador">Operador</option>
                    <option value="gerente">Gerente</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <label for="foto" style="font-size: 14px; font-weight: 600; color: #333;">Foto de Perfil (Opcional)</label>
                <input type="file" id="foto" name="foto" accept="image/*" style="padding: 10px; border: 1px solid #eaeaea; border-radius: 6px; font-size: 14px; background-color: #fff;">
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: 10px;">
                <button type="submit" class="btn-action btn-primary" style="padding: 12px 24px;">Cadastrar Funcionário</button>
            </div>
        </form>
    </div>
</div>
@endsection