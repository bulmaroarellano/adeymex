<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
            'codigo_postal' => $this->faker->postcode,
            'ciudad' => $this->faker->city,
            'codigo_estado' => $this->faker->countryCode,
            'municipio' => $this->faker->state,
            'direccion' => $this->faker->address,
        ];
    }
}
