<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use Illuminate\Http\Request;

class ClienteFavoritoController extends Controller
{
    public function index()
    {
        $favoritos = Favorito::with('produto')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('client.wishlist', compact('favoritos'));
    }

    public function store(Request $request, $produtoId)
    {
        Favorito::firstOrCreate([
            'user_id' => auth()->id(),
            'produto_id' => $produtoId,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Produto adicionado aos favoritos!');
    }

    public function destroy($id)
    {
        $favorito = Favorito::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $favorito->delete();

        return redirect()
            ->route('cliente.favoritos')
            ->with('success', 'Produto removido dos favoritos!');
    }

    public function removerPorProduto($produtoId)
    {
        Favorito::where('user_id', auth()->id())
            ->where('produto_id', $produtoId)
            ->delete();

        return redirect()
            ->back()
            ->with('success', 'Produto removido dos favoritos!');
    }
}