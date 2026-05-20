<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'desconto',
        'data_inicio',
        'data_fim',
        'quantidade',
        'status',
        'imagem_principal',
        'imagens_extras',
        'categoria',
        'cores',
    ];

    protected $casts = [
        'imagens_extras' => 'array',
        'cores' => 'array',
    ];
}