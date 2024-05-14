<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'doc'=>fake()->unique()->randomNumber(9, true),
            'nombre'=>fake()->firstName(),
            'apellido'=>fake()->lastName(),
            'tipo_doc'=>fake()->randomElement(['CC', 'CE']),
            'password'=>static::$password ??= Hash::make('clave'),
            'tel'=>fake()->randomNumber(9, true),
            'email'=>fake()->unique()->safeEmail(),
            'fecha_naci'=>fake()->dateTime(),
            'genero'=>fake()->randomElement(['femenino', 'masculino']),
            'direccion'=>fake()->streetAddress(),
            'rol_id'=>\App\Models\Role::pluck('id')->random()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
