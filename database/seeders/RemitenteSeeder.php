<?php

namespace Database\Seeders;

use App\Models\Pais;
use App\Models\Remitente;
use App\Models\Sucursal;
use Illuminate\Database\Seeder;
use Illuminate\Container\Container;
use Faker\Generator;
class RemitenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
    */

    protected $faker;

    public function __construct()
    {
        $this->faker = $this->withFaker();
        
    }

    /**
     * Get a new Faker instance.
     *
     * @return \Faker\Generator
     */
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

    public function run()
    {
        $sucursales = Sucursal::get(['sucursal']);
        $paises = Pais::get(['pais']);

        for ($i=0; $i < count($sucursales); $i++) { 
            $remitente = new Remitente();
            $remitente->sucursal = $sucursales[$i]->sucursal;
            $remitente->nombre = $this->faker->name();
            $remitente->apellidoP = $this->faker->lastName();
            $remitente->apellidoM = $this->faker->lastName();
            $remitente->empresa = $this->faker->company();
            $remitente->telefono = $this->faker->phoneNumber();
            $remitente->email = $this->faker->email();
            $remitente->tipoCliente = 'General';
            $remitente->domicilio1 = $this->faker->streetAddress();
            $remitente->domicilio2 = $this->faker->streetName();
            $remitente->domicilio3 = $this->faker->streetName();
            $remitente->pais = $paises[$i]->pais;
            $remitente->codigoPostal = $this->faker->postcode();
            $remitente->save();
        }
    }
}
