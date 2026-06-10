<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AreaClienteController extends Controller
{
    public function perfil()
    {
        return view('client.profile');
    }

    public function configuracao()
    {
        return view('client.settings');
    }

    public function enderecos()
    {
        return view('client.addresses');
    }

    public function criarEndereco()
    {
        return view('client.address-create');
    }

    public function editarEndereco()
    {
        return view('client.address-edit');
    }

    public function cartoes()
    {
        return view('client.cards');
    }

    public function criarCartao()
    {
        return view('client.card-create');
    }

    public function editarCartao()
    {
        return view('client.card-edit');
    }

    public function favoritos()
    {
        return view('client.wishlist');
    }
}