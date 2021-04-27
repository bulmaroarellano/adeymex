<?php

namespace Database\Factories;

use App\Models\CodigoPostal;
use Illuminate\Database\Eloquent\Factories\Factory;

class CodigoPostalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CodigoPostal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigoPostal' => $this->faker->postcode(),
            'direccion' => $this->faker->streetAddress(),
            'ciudad' => $this->faker->city(),
            'codigoEstado' => $this->faker->citySuffix(),
            'municipio' => $this->faker->state(),
        ];
    }
}
