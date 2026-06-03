<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\Pagamento;
use Illuminate\Support\Str;

class PagamentoSeeder extends Seeder
{
    public function run(): void
    {
        $pedidos = Pedido::all();

        foreach ($pedidos as $pedido) {
            $statusPagamento = match($pedido->status) {
                'cancelado' => 'recusado',
                'pendente' => 'pendente',
                default => 'aprovado'
            };

            Pagamento::create([
                'pedido_id' => $pedido->id,
                'transacao_id' => 'TX-' . strtoupper(Str::random(12)),
                'metodo' => $pedido->forma_pagamento,
                'status' => $statusPagamento,
                'valor' => $pedido->total,
                'created_at' => $pedido->created_at,
                'updated_at' => $pedido->updated_at,
            ]);
        }
    }
}