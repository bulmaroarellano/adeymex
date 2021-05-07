<?php

namespace Database\Factories;

use App\Models\Mercancia;
use App\Models\Pais;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MercanciaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mercancia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'producto' => $this->faker->word,
            'producto_ingles' => $this->faker->word,
            'clave_internacional' => $this->faker->md5,
            'costo' => $this->faker->randomNumber,
            'medida' => $this->faker->randomNumber,
            'peso' => $this->faker->randomNumber,
            'pais_id' => $this->faker->randomElement(Pais::pluck('id')->all()),
            'moneda_id' => \App\Models\Moneda::factory(),
            'unidad_id' => \App\Models\Unidad::factory(),
        ];
    }
}
