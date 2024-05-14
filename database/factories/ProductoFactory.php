<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom_producto'=>fake()->unique()->word(),
            'precio_producto'=>fake()->randomNumber(5, true),
            'detalle'=> $this->faker->sentence(),
            'codigo'=>fake()->unique()->text(9),
            'categorias_id'=>\App\Models\Categoria::pluck('id')->random()
        ];
    }
}
