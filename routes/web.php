<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DevolucaoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\AdminAuthController;

/* =========================================================
   LOJA - PÁGINAS PÚBLICAS
========================================================= */

Route::get('/', [ProductController::class, 'home'])->name('home');

Route::get('/produtos', [ProductController::class, 'index'])->name('products.index');

Route::get('/produtos/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/produto/{id}', [ProductController::class, 'show'])->name('product.detail');

/* =========================================================
   CARRINHO
========================================================= */

Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('cart');

Route::post('/carrinho/adicionar/{id}', [CarrinhoController::class, 'adicionar'])->name('cart.add');

Route::post('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('cart.remover');

Route::post('/carrinho/aumentar/{id}', [CarrinhoController::class, 'aumentar'])->name('cart.aumentar');

Route::post('/carrinho/diminuir/{id}', [CarrinhoController::class, 'diminuir'])->name('cart.diminuir');

Route::post('/carrinho/finalizar', [CarrinhoController::class, 'finalizar'])->name('cart.finalizar');

/* =========================================================
   PÁGINAS INSTITUCIONAIS / COMPRA
========================================================= */

Route::get('/sobre', function () {
    return view('about');
})->name('about');

Route::get('/dados-compra', function () {
    return view('payment.index');
})->name('payment.index');

Route::get('/pagamento-pix', function () {
    return view('payment.pix');
})->name('payment.pix');

Route::get('/compra-realizada', function () {
    return view('order.success');
})->name('order.success');

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
    
    Route::get('/login', [AdminAuthController::class, 'loginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    Route::middleware([\App\Http\Middleware\CheckAdminAccess::class])->group(function () {
        
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::get('/produtos', [ProdutoController::class, 'index']);
        Route::get('/produtos/create', [ProdutoController::class, 'create']);
        Route::post('/produtos', [ProdutoController::class, 'store']);
        Route::get('/produtos/{id}/edit', [ProdutoController::class, 'edit']);
        Route::put('/produtos/{id}', [ProdutoController::class, 'update']);

        Route::get('/pedidos', [PedidoController::class, 'index']);
        Route::get('/pedidos/{id}', [PedidoController::class, 'show']);

        Route::get('/pagamentos', [PagamentoController::class, 'index']);
        Route::get('/clientes', [ClienteController::class, 'index']);

        Route::get('/devolucoes', [DevolucaoController::class, 'index']);
        Route::get('/devolucoes/{id}', [DevolucaoController::class, 'show']);
        Route::post('/devolucoes/{id}/status', [DevolucaoController::class, 'updateStatus']);

        Route::get('/funcionarios', [FuncionarioController::class, 'index']);
        Route::get('/funcionarios/criar', [FuncionarioController::class, 'create']);
        Route::post('/funcionarios', [FuncionarioController::class, 'store']);
        Route::get('/funcionarios/{id}/editar', [FuncionarioController::class, 'edit']);
        Route::put('/funcionarios/{id}', [FuncionarioController::class, 'update']);
        
    });
});

/* =========================================================
   ÁREA DO CLIENTE
========================================================= */

Route::get('/cliente/enderecos', function () {
    return view('client.addresses');
});

Route::get('/cliente/enderecos/editar', function () {
    return view('client.address-edit');
});

Route::get('/cliente/enderecos/cadastrar', function () {
    return view('client.address-create');
});

Route::get('/cliente/pedidos', [PedidoController::class, 'meusPedidos']);

Route::get('/cliente/pedidos/{id}', [PedidoController::class, 'detalheCliente']);

Route::get('/cliente/cartoes', function () {
    return view('client.cards');
});

Route::get('/cliente/cartoes/cadastrar', function () {
    return view('client.card-create');
});

Route::get('/cliente/cartoes/editar', function () {
    return view('client.card-edit');
});

Route::get('/cliente/desejos', function () {
    return view('client.wishlist');
});

Route::get('/cliente/dados-pessoais', function () {
    return view('client.profile');
});

Route::get('/cliente/configuracao', function () {
    return view('client.settings');
});