<?php

namespace Database\Factories;

use App\Models\UnidadMedida;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnidadMedidaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UnidadMedida::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unidadMedida' => $this->faker->randomElement(['Pieza', 'Kilogramo', 'Litro', 'Metro']),
            'abreviacion' => $this->faker->randomElement(['Pz', 'Kg', 'L', 'm']),
        ];
    }
}
