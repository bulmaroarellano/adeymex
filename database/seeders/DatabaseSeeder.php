<?php

namespace Database\Seeders;
use \App\Models\Role;
use \App\Models\Permission;
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

    }
}
