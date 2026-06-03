<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\Devolucao;

class DevolucaoSeeder extends Seeder
{
    public function run(): void
    {
        $pedidos = Pedido::where('status', 'entregue')->inRandomOrder()->take(15)->get();

        foreach ($pedidos as $pedido) {
            Devolucao::factory()->create([
                'pedido_id' => $pedido->id,
                'valor_reembolso' => $pedido->total,
            ]);
        }
    }
}