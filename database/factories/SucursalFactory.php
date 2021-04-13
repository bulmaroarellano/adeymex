<?php

namespace Database\Factories;

use App\Models\Sucursal;
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
            'descripcion'=> $this->faker->firstName(),
            'telefono'=> $this->faker->phoneNumber(),
            'email'=> $this->faker->email(),
            'encargado'=> $this->faker->name(),
            'domicilio1'=> $this->faker->streetAddress(),
            'domicilio2'=> $this->faker->streetName(),
            'domicilio3'=> $this->faker->streetName(),
            'pais'=> $this->faker->randomElement(['MX-MEXICO', 'US-ESTADOS-UNIDOS']),
            'codigoPostal'=> $this->faker->postcode(),
        ];
    }
}
