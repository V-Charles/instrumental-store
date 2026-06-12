<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'total',
        'status',
        'transaction_id',
        'forma_pagamento',
        'pix_copia_cola',
        'pix_qr_code_base64',
        'cliente_nome',
        'cliente_email',
    ];

    public function itens()
    {
        return $this->hasMany(ItemPedido::class);
    }

    public function pagamento()
    {
        return $this->hasOne(Pagamento::class);
    }

    public function devolucao()
    {
        return $this->hasOne(Devolucao::class);
    }
}