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

        Sucursal::factory(8)->create();
        Pais::factory(8)->create();
        CodigoPostal::factory(8)->create();
        Moneda::factory(8)->create();
        UnidadMedida::factory(8)->create();
        
        $this->call(RemitenteSeeder::class);
        $this->call(DestinatarioSeeder::class);
        $this->call(SuministroSeeder::class);
        $this->call(MercanciaSeeder::class);

    }
}
