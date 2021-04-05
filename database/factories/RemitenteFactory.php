<?php

namespace Database\Factories;

use App\Models\Remitente;
use Illuminate\Database\Eloquent\Factories\Factory;

class RemitenteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Remitente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'direccion' => $this->faker->streetAddress(),
            'ciudad' => $this->faker->city(),
            'telefono' => $this->faker->phoneNumber(),
            'cp' => $this->faker->postcode(),
            'email' => $this->faker->email(),
            'peso' => $this->faker->randomDigit(),
            'largo' => $this->faker->randomDigit(),
            'ancho' => $this->faker->randomDigit(),
            'altura' => $this->faker->randomDigit(),
        ];
    }
}
