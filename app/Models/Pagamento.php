<?php

namespace App\Models;
use App\Models\Pedido;
use App\Models\Pagamento;
use App\Models\ItemPedido;
use App\Models\Produto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'transacao_id',
        'metodo',
        'status',
        'valor'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}