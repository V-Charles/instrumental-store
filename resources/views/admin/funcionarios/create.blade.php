@extends('layouts.admin')

@section('breadcrumb', isset($funcionario) ? __('messages.breadcrumb_edit_employee') : __('messages.breadcrumb_create_employee'))

@section('content')
<div class="details-header">
    <a href="/admin/funcionarios" class="back-link">
        <span class="material-symbols-outlined">arrow_back</span>
        {{ __('messages.back_to_team') }}
    </a>
</div>

<div class="details-grid" style="grid-template-columns: 1fr; max-width: 800px; margin: 0 auto;">
    <div class="details-card">
        <h3 class="details-card-title">{{ isset($funcionario) ? __('messages.edit_employee') : __('messages.create_new_employee') }}</h3>
        
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
                <label for="name" style="font-size: 14px; font-weight: 600; color: #333;">{{ __('messages.full_name') }}</label>
                <input type="text" id="name" name="name" value="{{ isset($funcionario) ? $funcionario->name : old('name') }}" required style="padding: 10px; border: 1px solid #eaeaea; border-radius: 6px; font-size: 14px;">
            </div>

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <label for="email" style="font-size: 14px; font-weight: 600; color: #333;">{{ __('messages.access_email') }}</label>
                <input type="email" id="email" name="email" value="{{ isset($funcionario) ? $funcionario->email : old('email') }}" required style="padding: 10px; border: 1px solid #eaeaea; border-radius: 6px; font-size: 14px;">
            </div>

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <label for="password" style="font-size: 14px; font-weight: 600; color: #333;">
                    {{ isset($funcionario) ? __('messages.new_password_help') : __('messages.initial_password') }}
                </label>
                <input type="password" id="password" name="password" {{ isset($funcionario) ? '' : 'required' }} style="padding: 10px; border: 1px solid #eaeaea; border-radius: 6px; font-size: 14px;">
            </div>

            @if(isset($funcionario))
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            @else
                <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
            @endif
            
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <label for="cargo" style="font-size: 14px; font-weight: 600; color: #333;">{{ __('messages.access_level') }}</label>
                    <select id="cargo" name="cargo" required style="padding: 10px; border: 1px solid #eaeaea; border-radius: 6px; font-size: 14px; background-color: #fff;">
                        <option value="operador" {{ (isset($funcionario) && $funcionario->cargo == 'operador') ? 'selected' : '' }}>{{ __('messages.role_operador') }}</option>
                        <option value="gerente" {{ (isset($funcionario) && $funcionario->cargo == 'gerente') ? 'selected' : '' }}>{{ __('messages.role_gerente') }}</option>
                        <option value="admin" {{ (isset($funcionario) && $funcionario->cargo == 'admin') ? 'selected' : '' }}>{{ __('messages.role_admin') }}</option>
                    </select>
                </div>

                @if(isset($funcionario))
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="ativo" style="font-size: 14px; font-weight: 600; color: #333;">{{ __('messages.account_status') }}</label>
                        <select id="ativo" name="ativo" required style="padding: 10px; border: 1px solid #eaeaea; border-radius: 6px; font-size: 14px; background-color: #fff;">
                            <option value="1" {{ $funcionario->ativo ? 'selected' : '' }}>{{ __('messages.status_active') }}</option>
                            <option value="0" {{ !$funcionario->ativo ? 'selected' : '' }}>{{ __('messages.status_inactive') }}</option>
                        </select>
                    </div>
                @endif
            </div>

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <label style="font-size: 14px; font-weight: 600; color: #333;">
                    {{ isset($funcionario) ? __('messages.update_profile_photo') : __('messages.profile_photo_optional') }}
                </label>
                
                <div class="custom-file-upload" style="display: flex; align-items: center; gap: 12px;">
                    <input type="file" id="foto" name="foto" accept="image/*" style="display: none;" onchange="updateFileName(this)">
                    
                    <button type="button" onclick="document.getElementById('foto').click()" style="padding: 10px 16px; border: 1px solid #eaeaea; border-radius: 6px; font-size: 14px; background-color: #fff; cursor: pointer; font-weight: 500; color: #555;">
                        {{ __('messages.btn_choose_file') ?? 'Choose File' }}
                    </button>
                    
                    <span id="file-name-text" style="font-size: 14px; color: #888;">
                        {{ __('messages.no_file_chosen') ?? 'No file chosen' }}
                    </span>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: 10px;">
                <button type="submit" class="btn-action btn-primary" style="padding: 12px 24px;">
                    {{ isset($funcionario) ? __('messages.save_changes') : __('messages.register_employee_btn') }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function updateFileName(input) {
    const textSpan = document.getElementById('file-name-text');
    if (input.files && input.files.length > 0) {
        textSpan.textContent = input.files[0].name;
        textSpan.style.color = '#333';
    } else {
        textSpan.textContent = "{{ __('messages.no_file_chosen') }}";
        textSpan.style.color = '#888';
    }
}
</script>
@endsection