@extends('layouts.admin')

@section('breadcrumb', isset($funcionario) ? 'Funcionários > Editar' : 'Funcionários > Cadastrar')

@section('content')
<div class="details-header">
    <a href="/admin/funcionarios" class="back-link">
        <span class="material-symbols-outlined">arrow_back</span>
        Voltar para Equipe
    </a>
</div>

<div class="details-grid" style="grid-template-columns: 1fr; max-width: 800px; margin: 0 auto;">
    <div class="details-card">
        <h3 class="details-card-title">{{ isset($funcionario) ? 'Editar Funcionário' : 'Cadastrar Novo Funcionário' }}</h3>
        
        @if($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 6px; margin-bottom: 20px; font-weight: 600; font-size: 14px; border: 1px solid #f5c6cb;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ isset($funcionario) ? '/admin/funcionarios/'.$funcionario->id : '/admin/funcionarios' }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 20px; margin-top: 20px;">
            @csrf
            
            @if(isset($funcionario))
                @method('PUT')
            @endif

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <label for="name" style="font-size: 14px; font-weight: 600; color: #333;">Nome Completo</label>
                <input type="text" id="name" name="name" value="{{ isset($funcionario) ? $funcionario->name : old('name') }}" required style="padding: 10px; border: 1px solid #eaeaea; border-radius: 6px; font-size: 14px;">
            </div>

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <label for="email" style="font-size: 14px; font-weight: 600; color: #333;">E-mail de Acesso</label>
                <input type="email" id="email" name="email" value="{{ isset($funcionario) ? $funcionario->email : old('email') }}" required style="padding: 10px; border: 1px solid #eaeaea; border-radius: 6px; font-size: 14px;">
            </div>

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <label for="password" style="font-size: 14px; font-weight: 600; color: #333;">
                    {{ isset($funcionario) ? 'Nova Senha (deixe em branco para não alterar)' : 'Senha Inicial' }}
                </label>
                <input type="password" id="password" name="password" {{ isset($funcionario) ? '' : 'required' }} style="padding: 10px; border: 1px solid #eaeaea; border-radius: 6px; font-size: 14px;">
            </div>

            @if(isset($funcionario))
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            @else
                <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
            @endif
            
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <label for="cargo" style="font-size: 14px; font-weight: 600; color: #333;">Nível de Acesso (Cargo)</label>
                    <select id="cargo" name="cargo" required style="padding: 10px; border: 1px solid #eaeaea; border-radius: 6px; font-size: 14px; background-color: #fff;">
                        <option value="operador" {{ (isset($funcionario) && $funcionario->cargo == 'operador') ? 'selected' : '' }}>Operador</option>
                        <option value="gerente" {{ (isset($funcionario) && $funcionario->cargo == 'gerente') ? 'selected' : '' }}>Gerente</option>
                        <option value="admin" {{ (isset($funcionario) && $funcionario->cargo == 'admin') ? 'selected' : '' }}>Administrador</option>
                    </select>
                </div>

                @if(isset($funcionario))
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="ativo" style="font-size: 14px; font-weight: 600; color: #333;">Status da Conta</label>
                        <select id="ativo" name="ativo" required style="padding: 10px; border: 1px solid #eaeaea; border-radius: 6px; font-size: 14px; background-color: #fff;">
                            <option value="1" {{ $funcionario->ativo ? 'selected' : '' }}>Ativo</option>
                            <option value="0" {{ !$funcionario->ativo ? 'selected' : '' }}>Inativo</option>
                        </select>
                    </div>
                @endif
            </div>

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <label for="foto" style="font-size: 14px; font-weight: 600; color: #333;">
                    {{ isset($funcionario) ? 'Atualizar Foto de Perfil' : 'Foto de Perfil (Opcional)' }}
                </label>
                <input type="file" id="foto" name="foto" accept="image/*" style="padding: 10px; border: 1px solid #eaeaea; border-radius: 6px; font-size: 14px; background-color: #fff;">
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: 10px;">
                <button type="submit" class="btn-action btn-primary" style="padding: 12px 24px;">
                    {{ isset($funcionario) ? 'Salvar Alterações' : 'Cadastrar Funcionário' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection