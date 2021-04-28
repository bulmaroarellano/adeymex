<?php

namespace Database\Factories;

use App\Models\Moneda;
use Illuminate\Database\Eloquent\Factories\Factory;

class MonedaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Moneda::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'moneda' => $this->faker->locale(),
            'codigo' => $this->faker->currencyCode(),
            'simbolo' => $this->faker->languageCode(),
        ];
    }
}
