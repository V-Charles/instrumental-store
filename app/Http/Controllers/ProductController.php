<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function home()
    {
        $categorias = Produto::select('categoria')
            ->where('status', 'ativo')
            ->distinct()
            ->pluck('categoria');

        $produtosDestaque = Produto::where('status', 'ativo')
            ->latest()
            ->take(12)
            ->get();

        $outrosProdutos = Produto::where('status', 'ativo')
            ->latest()
            ->skip(12)
            ->take(12)
            ->get();

        return view('home', compact(
            'categorias',
            'produtosDestaque',
            'outrosProdutos'
        ));
    }

    public function index(Request $request)
    {
        $categorias = Produto::select('categoria')
            ->where('status', 'ativo')
            ->distinct()
            ->pluck('categoria');

        $produtos = Produto::query()
            ->where('status', 'ativo')
            ->when($request->filled('categoria') && $request->categoria !== 'todos', function ($query) use ($request) {
                $query->where('categoria', $request->categoria);
            })
            ->latest()
            ->paginate(24)
            ->withQueryString();

        return view('products.index', compact(
            'produtos',
            'categorias'
        ));
    }

    public function show($id)
    {
        $produto = Produto::where('status', 'ativo')
            ->findOrFail($id);

        $produtosSimilares = Produto::where('categoria', $produto->categoria)
            ->where('id', '!=', $produto->id)
            ->where('status', 'ativo')
            ->latest()
            ->take(12)
            ->get();

        return view('product-detail', compact(
            'produto',
            'produtosSimilares'
        ));
    }
}