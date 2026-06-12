<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cartao extends Model
{
    protected $fillable = [
        'user_id',
        'apelido_cartao',
        'tipo_cartao',
        'nome_impresso',
        'numero_cartao',
        'validade',
        'codigo_seguranca',
        'bandeira',
        'principal',
    ];
}