<?php

namespace Database\Seeders;

use App\Models\Destinatario;
use Illuminate\Database\Seeder;

class DestinatarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Destinatario::factory()
            ->count(5)
            ->create();
    }
}
