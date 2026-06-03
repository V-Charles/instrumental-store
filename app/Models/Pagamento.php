<?php

namespace App\Models;

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