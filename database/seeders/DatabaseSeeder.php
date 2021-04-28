<?php

namespace Database\Seeders;

use App\Models\CodigoPostal;
use App\Models\Mensajeria;
use App\Models\Moneda;
use App\Models\Pais;
use \App\Models\Role;
use \App\Models\Permission;
use App\Models\Sucursal;
use App\Models\UnidadMedida;
use Illuminate\Database\Seeder;
use \App\Models\User as User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(BlockedTypeTableSeeder::class);
        $this->call(BlockedItemsTableSeeder::class);    
       // $this->call(PermissionTableSeeder::class);
   
  //      $this->call(PermissionTableSeeder::class);
        $this->call(CreateUsers::class);
        Sucursal::factory(8)->create();
        Pais::factory(8)->create();
        CodigoPostal::factory(8)->create();
        Moneda::factory(8)->create();
        UnidadMedida::factory(8)->create();
        Mensajeria::factory(8)->create();
        
        $this->call(RemitenteSeeder::class);
        $this->call(DestinatarioSeeder::class);
        $this->call(SuministroSeeder::class);
        $this->call(MercanciaSeeder::class);

    }
}
