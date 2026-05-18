<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrumental Store</title>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <script src="{{ asset('js/script.js') }}"></script>
</head>
<body>
<div class="auth-language">
    <a href="{{ route('lang.switch', app()->getLocale() === 'pt' ? 'en' : 'pt') }}">
        <span class="material-symbols-outlined">language</span>
    </a>
</div>
    <main>
        @yield('content')
    </main>
</body>
</html>