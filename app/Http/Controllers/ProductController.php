<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function home()
    {
        $categorias = Produto::select('categoria')
            ->distinct()
            ->pluck('categoria');

        $produtosDestaque = Produto::take(4)->get();
        $outrosProdutos = Produto::skip(4)->take(8)->get();

        return view('home', compact(
            'categorias',
            'produtosDestaque',
            'outrosProdutos'
        ));
    }

    public function index(Request $request)
    {
        $categorias = Produto::select('categoria')
            ->distinct()
            ->pluck('categoria');

        $produtos = Produto::query()
            ->when($request->filled('categoria') && $request->categoria !== 'todos', function ($query) use ($request) {
                $query->where('categoria', $request->categoria);
            })
            ->paginate(12)
            ->withQueryString();

        return view('products.index', compact('produtos', 'categorias'));
    }

    public function show($id)
    {
        $produto = Produto::findOrFail($id);

        $produtosSimilares = Produto::where('categoria', $produto->categoria)
            ->where('id', '!=', $produto->id)
            ->take(4)
            ->get();

        return view('product-detail', compact(
            'produto',
            'produtosSimilares'
        ));
    }
}