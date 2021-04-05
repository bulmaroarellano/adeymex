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
            'nombre' => $this->faker->name(),
            'direccion' => $this->faker->streetAddress(),
            'ciudad' => $this->faker->city(),
            'telefono' => $this->faker->phoneNumber(),
            'cp' => $this->faker->postcode(),
        ];
    }
}
