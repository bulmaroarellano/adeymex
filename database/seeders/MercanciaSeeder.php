<?php

namespace Database\Seeders;

use App\Models\Mercancia;
use Illuminate\Database\Seeder;

class MercanciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mercancia::factory()
            ->count(5)
            ->create();
    }
}
