<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\AuthController;

/* =========================================================
   LOJA - PÁGINAS PÚBLICAS
========================================================= */

Route::get('/', [ProductController::class, 'home'])->name('home');

Route::get('/produtos', [ProductController::class, 'index'])->name('products.index');

Route::get('/produtos/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/produto/{id}', [ProductController::class, 'show'])->name('product.detail');

Route::get('/sobre', function () {
    return view('about');
})->name('about');

/* =========================================================
   AUTENTICAÇÃO - LOGIN E CADASTRO
========================================================= */

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/cadastro', [AuthController::class, 'registerForm'])->name('register');
Route::post('/cadastro', [AuthController::class, 'register'])->name('register.submit');

Route::get('/recuperar-senha', function () {
    return view('auth.forgot-password');
})->name('password.forgot');

Route::get('/nova-senha', function () {
    return view('auth.reset-password');
})->name('password.reset');


/* =========================================================
   IDIOMA - INTERNACIONALIZAÇÃO
========================================================= */

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['pt', 'en'])) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('lang.switch');


/* =========================================================
   ADMINISTRAÇÃO DA LOJA
========================================================= */

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('/produtos', [ProdutoController::class, 'index']);
    Route::get('/produtos/create', [ProdutoController::class, 'create']);
    Route::post('/produtos', [ProdutoController::class, 'store']);
});


/* =========================================================
   ÁREA DO CLIENTE
========================================================= */

Route::get('/cliente/dados-pessoais', function () {
    return view('client.profile');
});

Route::get('/cliente/enderecos', function () {
    return view('client.addresses');
});

Route::get('/cliente/enderecos/editar', function () {
    return view('client.address-edit');
});