<?php

namespace Database\Seeders;

use App\Models\Destinatario;
use App\Models\Remitente;
use App\Models\Sucursal;
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
        // Remitente::factory(10)->create();

        Sucursal::factory(10)->create();
        //+ Traer los datos de la db de remitente y crear un factory de envios 
        // $this->call(EnvioSeeder::class);
        $this->call(RemitenteSeeder::class);
        $this->call(DestinatarioSeeder::class);
        $this->call(SuministroSeeder::class);

    }
}
