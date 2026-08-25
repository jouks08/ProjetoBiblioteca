<?php

namespace Database\Factories;

use App\Models\Autor;
use App\Models\Livro;
use Illuminate\Database\Eloquent\Factories\Factory;
class LivroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => fake()->sentence(3),
            'ano_publicacao' => fake()->numberBetween(1800, 2024),
            'autor_id' => Autor::factory(), // Cria automaticamente um autor associado
        ];
    }
}