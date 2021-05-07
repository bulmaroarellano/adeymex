<?php

namespace Database\Seeders;

use App\Models\Pais;
use Illuminate\Database\Seeder;
use PragmaRX\Countries\Package\Services\Countries;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $countries = new Countries();
        $paises = $countries->all()->pluck('name.common')->toArray();
        Pais::factory()
            ->count(count($paises))
            ->create();
        // Pais::factory()
        //     ->count(5)
        //     ->create();
    }
}
