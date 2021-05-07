<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Destinatario;
use App\Models\Pais;
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
            'nombre' => $this->faker->name,
            'apellido_paterno' => $this->faker->lastName,
            'apellido_materno' => $this->faker->lastName,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'domicilio1' => $this->faker->address,
            'domicilio2' => $this->faker->address,
            'domicilio3' => $this->faker->address,
            'codigo_postal' => $this->faker->postcode,
            'sucursal_id' => \App\Models\Sucursal::factory(),
            'pais_id' => $this->faker->randomElement(Pais::pluck('id')->all()),
            'empresa_id' => \App\Models\Empresa::factory(),
        ];
    }
}
