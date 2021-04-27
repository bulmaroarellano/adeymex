<?php

namespace Database\Seeders;

use App\Models\Destinatario;
use App\Models\Sucursal;
use Illuminate\Database\Seeder;
use Illuminate\Container\Container;
use Faker\Generator;

class DestinatarioSeeder extends Seeder
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
        $sucursalesDescripcion = Sucursal::get(['descripcion']);

        for ($i=0; $i < count($sucursalesDescripcion); $i++) { 

            $destinatario = new Destinatario();

            $destinatario->sucursal =  $sucursalesDescripcion[$i]->descripcion;
            $destinatario->nombre = $this->faker->name(); 
            $destinatario->apellidoP = $this->faker->lastName(); 
            $destinatario->apellidoM = $this->faker->lastName(); 
            $destinatario->empresa = $this->faker->company(); 
            $destinatario->telefono = $this->faker->phoneNumber(); 
            $destinatario->email = $this->faker->email(); 
            $destinatario->domicilio1 = $this->faker->streetAddress();
            $destinatario->domicilio2 = $this->faker->streetName();
            $destinatario->domicilio3 = $this->faker->streetName();
            $destinatario->pais = $this->faker->randomElement(['MX-MEXICO', 'US-ESTADOS-UNIDOS']); 
            $destinatario->codigoPostal = $this->faker->postcode();
            $destinatario->save();


        }

    }
}
