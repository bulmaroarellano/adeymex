<?php

namespace Database\Factories;

use App\Models\Pais;
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
            'nombre' => $this->faker->name,
            'apellido_paterno' => $this->faker->lastName,
            'apellido_materno' => $this->faker->lastName,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'domicilio1' => $this->faker->address,
            'domicilio2' => $this->faker->text,
            'domicilio3' => $this->faker->text,
            'codigo_postal' => $this->faker->postcode,
            'sucursal_id' => \App\Models\Sucursal::factory(),
            'pais_id' => $this->faker->randomElement(Pais::pluck('id')->all()),
            'cliente_id' => \App\Models\Cliente::factory(),
            'empresa_id' => \App\Models\Empresa::factory(),
        ];
    }
}
