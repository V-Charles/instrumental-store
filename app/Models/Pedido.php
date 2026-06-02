<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'codigo',
        'total',
        'status',
        'forma_pagamento',
        'cliente_nome',
        'cliente_email'
    ];

    public function itens()
    {
        return $this->hasMany(ItemPedido::class);
    }
}