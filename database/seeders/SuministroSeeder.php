<?php

namespace Database\Seeders;

use App\Models\Suministro;
use Illuminate\Database\Seeder;

class SuministroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Suministro::factory()
            ->count(5)
            ->create();
    }
}
