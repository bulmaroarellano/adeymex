<?php

namespace Database\Seeders;

use App\Models\Sucursal;
use App\Models\Suministro;
use Illuminate\Database\Seeder;
use Illuminate\Container\Container;
use Faker\Generator;

class SuministroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
    */

    protected $faker;

    public function __construct()
    {
        $this->faker = $this->withFaker();
        
    }

    /**
     * Get a new Faker instance.
     *
     * @return \Faker\Generator
     */
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }
    public function run()
    {
        $sucursalesDescripcion = Sucursal::get(['descripcion']);

        for ($i=0; $i < count($sucursalesDescripcion); $i++) { 

            $suministro = new Suministro();
            $suministro->sucursal = $sucursalesDescripcion[$i]->descripcion;
            $suministro->producto = $this->faker->word();
            $suministro->costo = $this->faker->randomDigitNot(0);
            $suministro->precioPublico = $this->faker->randomDigitNot(0);

            $suministro->save();


        }

    }
}
