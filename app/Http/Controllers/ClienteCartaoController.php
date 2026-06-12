<?php

namespace App\Http\Controllers;

class ClienteCartaoController extends Controller
{
    public function index()
    {
        return view('client.cards');
    }

    public function create()
    {
        return view('client.card-create');
    }

    public function edit()
    {
        return view('client.card-edit');
    }
}