<?php

namespace Database\Seeders;

use App\Models\Encargado;
use Illuminate\Database\Seeder;

class EncargadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Encargado::factory()
            ->count(5)
            ->create();
    }
}
