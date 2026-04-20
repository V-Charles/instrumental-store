<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Product;

class ProductController extends Controller
{
    public function home(){
        return view('home');
    }

    public function index(){
        return view('products.index');
    }

    public function show($id){
        return view('products.show', compact('id'));
    }
}
