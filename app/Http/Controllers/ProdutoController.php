<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        $totalProdutos = $produtos->count();
        return view('admin.produtos.index', compact('produtos', 'totalProdutos'));
    }

    public function create()
    {
        return view('admin.produtos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required',
            'categoria' => 'required',
            'status' => 'required',
            'imagem_principal' => 'required|image',
            'imagens_extras' => 'nullable|array|max:4', 
        ]);

        $data = $request->all();

        $precoLimpo = preg_replace('/[^0-9,]/', '', $request->preco);
        $data['preco'] = (float) str_replace(',', '.', $precoLimpo);

        if ($request->filled('desconto')) {
            $descontoLimpo = preg_replace('/[^0-9,]/', '', $request->desconto);
            $data['desconto'] = (float) str_replace(',', '.', $descontoLimpo);
        }

        if ($request->hasFile('imagem_principal')) {
            $data['imagem_principal'] = $request->file('imagem_principal')->store('produtos', 'public');
        }

        if ($request->hasFile('imagens_extras')) {
            $imagens = [];
            foreach ($request->file('imagens_extras') as $file) {
                $imagens[] = $file->store('produtos/galeria', 'public');
            }
            $data['imagens_extras'] = $imagens;
        }

        $data['cores'] = $request->input('cores', []);

        Produto::create($data);

        return redirect('/admin/produtos');
    }
}