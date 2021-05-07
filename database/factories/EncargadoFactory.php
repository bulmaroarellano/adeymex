<?php

namespace Database\Factories;

use App\Models\Encargado;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EncargadoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Encargado::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'sucursal_id' => \App\Models\Sucursal::factory(),
        ];
    }
}
