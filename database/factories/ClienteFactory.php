<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'tipo_cliente_id' => \App\Models\TipoCliente::factory(),
        ];
    }
}
