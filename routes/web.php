<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Tela inicial (home)
Route::get('/', [ProductController::class, 'home'])->name('home');

// Catálogo de Produtos
Route::get('/produtos', [ProductController::class, 'index'])->name('products.index');

// Detalhes de um produto
Route::get('/produtos/{id}', [ProductController::class, 'show'])->name('products.show');

// Telas de login e cadastro
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/cadastro', [AuthController::class, 'registerForm'])->name('register');
Route::post('/cadastro', [AuthController::class, 'register'])->name('register.submit');

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['pt', 'en'])) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('lang.switch');

// Rotas administrativas
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
});