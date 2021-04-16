<?php

namespace Database\Seeders;

use App\Models\CodigoPostal;
use App\Models\Moneda;
use App\Models\Pais;
use App\Models\Sucursal;
use App\Models\UnidadMedida;
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
        Pais::factory(10)->create();
        CodigoPostal::factory(10)->create();
        Moneda::factory(10)->create();
        UnidadMedida::factory(5)->create();
        
        $this->call(RemitenteSeeder::class);
        $this->call(DestinatarioSeeder::class);
        $this->call(SuministroSeeder::class);

    }
}
