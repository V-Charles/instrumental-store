<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pedido;
use App\Models\Produto;

class ItemPedidoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pedido_id' => Pedido::factory(),
            'produto_id' => Produto::inRandomOrder()->value('id') ?? 1,
            'quantidade' => fake()->numberBetween(1, 4),
            'preco_unitario' => fake()->randomFloat(2, 10, 1500),
        ];
    }
}