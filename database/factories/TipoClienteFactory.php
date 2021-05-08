<?php

namespace Database\Factories;

use App\Models\TipoCliente;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TipoClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TipoCliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tipo_cliente' => $this->faker->randomElement(['premium', 'general', 'basico', 'express', 'combo']),
        ];
    }
}
