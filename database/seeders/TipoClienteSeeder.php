<?php

namespace Database\Seeders;

use App\Models\TipoCliente;
use Illuminate\Database\Seeder;

class TipoClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoCliente::factory()
            ->count(5)
            ->create();
    }
}
