<?php

namespace Database\Seeders;

use App\Models\Unidad;
use Illuminate\Database\Seeder;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unidad::factory()
            ->count(5)
            ->create();
    }
}
