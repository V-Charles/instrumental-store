<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $query = Produto::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%")
                  ->orWhere('marca', 'like', "%{$search}%")
                  ->orWhere('categoria', 'like', "%{$search}%")
                  ->orWhere('descricao', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('categorias')) {
            $query->whereIn('categoria', $request->categorias);
        }

        if ($request->filled('status') && $request->status !== 'destaque') {
            $query->where('status', $request->status);
        }

        $produtos = $query->latest()->get();
        $totalProdutos = Produto::count();

        if ($request->wantsJson()) {
            $produtos->transform(function($produto) {
                $produto->data_criacao_formatada = $produto->created_at->format('d/m/Y');
                return $produto;
            });
            return response()->json($produtos);
        }

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
            'marca' => 'required|string|max:255',
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

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        return view('admin.produtos.create', compact('produto'));
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required',
            'categoria' => 'required',
            'status' => 'required',
            'imagem_principal' => 'nullable|image',
            'imagens_extras' => 'nullable|array|max:4',
        ]);

        $data = $request->all();

        $precoLimpo = preg_replace('/[^0-9,]/', '', $request->preco);
        $data['preco'] = (float) str_replace(',', '.', $precoLimpo);

        if ($request->filled('desconto')) {
            $descontoLimpo = preg_replace('/[^0-9,]/', '', $request->desconto);
            $data['desconto'] = (float) str_replace(',', '.', $descontoLimpo);
        } else {
            $data['desconto'] = null;
        }

        if ($request->hasFile('imagem_principal')) {
            if ($produto->imagem_principal) {
                Storage::disk('public')->delete($produto->imagem_principal);
            }
            $data['imagem_principal'] = $request->file('imagem_principal')->store('produtos', 'public');
        }

        if ($request->hasFile('imagens_extras')) {
            if ($produto->imagens_extras) {
                foreach ($produto->imagens_extras as $antiga) {
                    Storage::disk('public')->delete($antiga);
                }
            }
            $imagens = [];
            foreach ($request->file('imagens_extras') as $file) {
                $imagens[] = $file->store('produtos/galeria', 'public');
            }
            $data['imagens_extras'] = $imagens;
        }

        $data['cores'] = $request->input('cores', []);

        $produto->update($data);

        return redirect('/admin/produtos');
    }
}