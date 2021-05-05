<?php

namespace Database\Factories;

use App\Models\Unidad;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnidadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Unidad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unidad_medida' => $this->faker->word,
            'abreviacion' => $this->faker->word,
        ];
    }
}
