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
            'nombre_remitente' => $this->faker->name(),
            'direccion_remitente' => $this->faker->streetAddress(),
            'ciudad_remitente' => $this->faker->city(),
            'telefono_remitente' => $this->faker->phoneNumber(),
            'cp_remitente' => $this->faker->postcode(),
            'email_remitente' => $this->faker->email(),
            'peso_remitente' => $this->faker->randomDigit(),
            'largo_remitente' => $this->faker->randomDigit(),
            'ancho_remitente' => $this->faker->randomDigit(),
            'altura_remitente' => $this->faker->randomDigit(),
        ];
    }
}
