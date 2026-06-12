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
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ClienteDadosController;
use App\Http\Controllers\ClienteConfiguracaoController;
use App\Http\Controllers\ClienteEnderecoController;
use App\Http\Controllers\ClienteCartaoController;
use App\Http\Controllers\ClienteFavoritoController;

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

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/* =========================================================
   LOGIN COM GOOGLE
========================================================= */

Route::get('/auth/google', [GoogleController::class, 'redirect'])
    ->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

/* =========================================================
   RECUPERAÇÃO DE SENHA
========================================================= */

Route::get('/recuperar-senha', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('/recuperar-senha', [ForgotPasswordController::class, 'sendResetLink'])
    ->name('password.email');

Route::get('/nova-senha/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/nova-senha', [ResetPasswordController::class, 'resetPassword'])
    ->name('password.update');

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

        Route::get('/pedidos', [PedidoController::class, 'index']);

        Route::get('/pedidos/{id}', [PedidoController::class, 'show']);

        Route::put('/pedidos/{id}/status', [PedidoController::class, 'atualizarStatus'])
            ->name('admin.pedidos.status');

        Route::get('/pagamentos', [PagamentoController::class, 'index']);

        Route::get('/clientes', [ClienteController::class, 'index']);

        Route::get('/devolucoes', [DevolucaoController::class, 'index']);

        Route::middleware([\App\Http\Middleware\CheckManagerAccess::class])->group(function () {

            Route::get('/produtos/create', [ProdutoController::class, 'create']);

            Route::post('/produtos', [ProdutoController::class, 'store']);

            Route::get('/produtos/{id}/edit', [ProdutoController::class, 'edit']);

            Route::put('/produtos/{id}', [ProdutoController::class, 'update']);

            Route::get('/devolucoes/{id}', [DevolucaoController::class, 'show']);

            Route::post('/devolucoes/{id}/status', [DevolucaoController::class, 'updateStatus']);

            Route::get('/funcionarios', [FuncionarioController::class, 'index']);

            Route::get('/funcionarios/criar', [FuncionarioController::class, 'create']);

            Route::post('/funcionarios', [FuncionarioController::class, 'store']);

            Route::get('/funcionarios/{id}/editar', [FuncionarioController::class, 'edit']);

            Route::put('/funcionarios/{id}', [FuncionarioController::class, 'update']);
        });
    });
});

/* =========================================================
   ÁREA DO CLIENTE
========================================================= */

Route::middleware(['auth'])->group(function () {

    Route::get('/cliente/dados-pessoais', [ClienteDadosController::class, 'index'])
        ->name('cliente.dados');

    Route::put('/cliente/dados-pessoais', [ClienteDadosController::class, 'update'])
        ->name('cliente.dados.atualizar');

    Route::get('/cliente/configuracao', [ClienteConfiguracaoController::class, 'index'])
        ->name('cliente.configuracao');

    Route::put('/cliente/configuracao/senha', [ClienteConfiguracaoController::class, 'atualizarSenha'])
        ->name('cliente.configuracao.senha');

    Route::put('/cliente/configuracao/idioma', [ClienteConfiguracaoController::class, 'atualizarIdioma'])
        ->name('cliente.configuracao.idioma');

    Route::delete('/cliente/configuracao/excluir', [ClienteConfiguracaoController::class, 'excluirConta'])
        ->name('cliente.configuracao.excluir');

    Route::get('/cliente/enderecos', [ClienteEnderecoController::class, 'index']);

    Route::get('/cliente/enderecos/cadastrar', [ClienteEnderecoController::class, 'create']);

    Route::get('/cliente/enderecos/editar', [ClienteEnderecoController::class, 'edit']);

    Route::get('/cliente/cartoes', [ClienteCartaoController::class, 'index']);

    Route::get('/cliente/cartoes/cadastrar', [ClienteCartaoController::class, 'create']);

    Route::get('/cliente/cartoes/editar', [ClienteCartaoController::class, 'edit']);

    Route::get('/cliente/desejos', [ClienteFavoritoController::class, 'index']);

    Route::get('/cliente/pedidos', [PedidoController::class, 'meusPedidos']);

    Route::get('/cliente/pedidos/{id}', [PedidoController::class, 'detalheCliente']);
});