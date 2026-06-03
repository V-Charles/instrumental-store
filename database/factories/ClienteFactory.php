<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'cpf' => fake()->numerify('###.###.###-##'),
            'telefone' => fake()->numerify('(##) 9####-####'),
            'data_nascimento' => fake()->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
            'sexo' => fake()->randomElement(['masculino', 'feminino', 'outro', 'prefiro_nao_informar']),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }
}