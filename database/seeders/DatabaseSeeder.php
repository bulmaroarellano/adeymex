<?php

namespace Database\Seeders;

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
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        // $this->call(PermissionsSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(UserSeeder::class);
        
        $this->call(MonedaSeeder::class);
        $this->call(PaisSeeder::class);
        $this->call(RemitenteSeeder::class);
        $this->call(DestinatarioSeeder::class);
        $this->call(SucursalSeeder::class);
        $this->call(EncargadoSeeder::class);
        $this->call(SuministroSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(TipoClienteSeeder::class);
        $this->call(EmpresaSeeder::class);
        $this->call(MercanciaSeeder::class);
        $this->call(UnidadSeeder::class);
        // $this->call(UserSeeder::class);
        $this->call(CodigoPostalSeeder::class);

        
    }
}
