<?php

namespace Database\Seeders;

use App\Models\CodigoPostal;
use Illuminate\Database\Seeder;

class CodigoPostalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CodigoPostal::factory()
            ->count(5)
            ->create();
    }
}
