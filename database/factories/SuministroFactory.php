<?php

namespace Database\Factories;

use App\Models\Suministro;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuministroFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Suministro::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->word(),
            'costo' => $this->faker->randomDigit,
            'precio_publico' => $this->faker->randomDigit,
            'sucursal_id' => \App\Models\Sucursal::factory(),
        ];
    }
}
