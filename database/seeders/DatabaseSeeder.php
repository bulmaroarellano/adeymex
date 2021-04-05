<?php

namespace Database\Seeders;

use App\Models\Destinatario;
use App\Models\Remitente;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Remitente::factory(10)->create();
        Destinatario::factory(10)->create();
        //+ Traer los datos de la db de remitente y crear un factory de envios 
        $this->call(EnvioSeeder::class);

    }
}
