<?php

namespace Database\Seeders;

use App\Models\Remitente;
use Illuminate\Database\Seeder;

class RemitenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Remitente::factory()
            ->count(5)
            ->create();
    }
}
