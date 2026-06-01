<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
// use App\Models\Product;

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

    public function index(){
        return view('products.index');
    }

    public function show($id)
    {
        $produto = Produto::findOrFail($id);
        return view('products.show', compact('produto'));
    }
}
