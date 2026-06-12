<?php

namespace App\Http\Controllers;

class ClienteEnderecoController extends Controller
{
    public function index()
    {
        return view('client.addresses');
    }

    public function create()
    {
        return view('client.address-create');
    }

    public function edit()
    {
        return view('client.address-edit');
    }
}