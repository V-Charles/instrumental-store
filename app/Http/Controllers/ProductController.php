<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function home()
    {
        $categorias = Produto::select('categoria')
            ->where('status', 'em_estoque')
            ->distinct()
            ->pluck('categoria');

        $produtosDestaque = Produto::where('status', 'em_estoque')
            ->latest()
            ->take(12)
            ->get();

        $outrosProdutos = Produto::where('status', 'em_estoque')
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
            ->where('status', 'em_estoque')
            ->distinct()
            ->pluck('categoria');

        $produtos = Produto::query()
            ->where('status', 'em_estoque')
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
        $produto = Produto::where('status', 'em_estoque')
            ->findOrFail($id);

        $produtosSimilares = Produto::where('categoria', $produto->categoria)
            ->where('id', '!=', $produto->id)
            ->where('status', 'em_estoque')
            ->latest()
            ->take(12)
            ->get();

        return view('product-detail', compact(
            'produto',
            'produtosSimilares'
        ));
    }
}