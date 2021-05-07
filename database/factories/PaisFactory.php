<?php

namespace Database\Factories;

use App\Models\Moneda;
use App\Models\Pais;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use PragmaRX\Countries\Package\Services\Countries;

class PaisFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pais::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $countries = new Countries();
        $paises = $countries->all()->pluck('name.common')->toArray();
        static $contador = 0;
        return [
            'nombre' => $paises[$contador++],
            'codigo' => $this->faker->countryCode,
            'moneda_id' => $this->faker->randomElement(Moneda::pluck('id')->all()),
        ];
    }
}
