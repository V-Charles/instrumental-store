<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\ItemPedido;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        Pedido::factory(50)->create()->each(function ($pedido) {
            ItemPedido::factory(rand(1, 4))->create([
                'pedido_id' => $pedido->id,
            ]);
        });
    }
}