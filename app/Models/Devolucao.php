<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucao extends Model
{
    use HasFactory;

    protected $table = 'devolucoes';

    protected $fillable = [
        'pedido_id',
        'codigo_rastreio',
        'motivo',
        'observacoes',
        'status',
        'valor_reembolso'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}