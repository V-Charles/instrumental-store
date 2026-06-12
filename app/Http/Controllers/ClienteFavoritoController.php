<?php

namespace App\Http\Controllers;

class ClienteFavoritoController extends Controller
{
    public function index()
    {
        return view('client.wishlist');
    }
}