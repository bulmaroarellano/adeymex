<?php

namespace Database\Seeders;

use App\Models\Destinatario;
use App\Models\Envio;
use App\Models\Remitente;
use Illuminate\Database\Seeder;
use Illuminate\Container\Container;

use Faker\Generator;

class EnvioSeeder extends Seeder 
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
        

        $nombreEnvio= Remitente::get(['nombre_remitente']);
        $destino = Destinatario::get(['ciudad_destinatario']);
        for($i = 0; $i< count($nombreEnvio->all()) ; $i++){
            $envio = new Envio();
            $envio->nombre_remitente =  $nombreEnvio[$i]->nombre_remitente;
            $envio->ciudad_destinatario = $destino[$i]->ciudad_destinatario;
            $envio->status =  $this->faker->randomElement(['Entregado', 'Rechazado', 'En camino']);
            $envio->save();
        } 

        
    }
}
