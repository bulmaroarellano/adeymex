<?php

namespace Database\Factories;

use App\Models\Pais;
use App\Models\Sucursal;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SucursalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sucursal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->company,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'codigo_postal' => $this->faker->postcode,
            'domicilio1' => $this->faker->address,
            'domicilo2' => $this->faker->text,
            'domicilio3' => $this->faker->text,
            'pais_id' => $this->faker->randomElement(Pais::pluck('id')->all()),
        ];
    }
}
