<?php

namespace Database\Factories;

use App\Models\Destinatario;
use Illuminate\Database\Eloquent\Factories\Factory;

class DestinatarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Destinatario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_destinatario' => $this->faker->name(),
            'direccion_destinatario' => $this->faker->streetAddress(),
            'ciudad_destinatario' => $this->faker->city(),
            'telefono_destinatario' => $this->faker->phoneNumber(),
            'cp_destinatario' => $this->faker->postcode(),
        ];
    }
}
