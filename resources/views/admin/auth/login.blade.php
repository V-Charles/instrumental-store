<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login da Equipe - Instrumental Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
</head>
<body>

    <div class="login-container">
        
        <div class="login-left">
            <form class="login-form" action="{{ route('admin.login.submit') }}" method="POST">
                @csrf

                @if($errors->any())
                    <div class="error-box">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="form-group">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                </div>

                <button type="submit" class="btn-submit">Entrar</button>
            </form>
        </div>

        <div class="login-right">
            <img src="{{ asset('images/guitarra-stratocaster.jpg') }}" alt="Guitarra Instrumental Store" class="login-image">
        </div>

    </div>

</body>
</html>