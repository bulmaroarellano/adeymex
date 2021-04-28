<?php

namespace Database\Seeders;

use App\Models\Mercancia;
use App\Models\Moneda;
use App\Models\Pais;
use App\Models\UnidadMedida;
use Illuminate\Database\Seeder;

use Illuminate\Container\Container;
use Faker\Generator;

class MercanciaSeeder extends Seeder
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
        $monedas = Moneda::get(['moneda']);
        $unidadesMedida = UnidadMedida::get(['unidadMedida']);
        $paises = Pais::get(['pais']);

        for ($i=0; $i < count($paises); $i++) { 
            $mercancia = new Mercancia();
            $mercancia->producto = $this->faker->word();
            $mercancia->productoIngles = $this->faker->word();
            $mercancia->claveInternacional = $this->faker->numberBetween($min = 1000, $max = 9000);
            $mercancia->costo = $this->faker->numberBetween($min = 100, $max = 500);
            $mercancia->moneda = $monedas[$i]->moneda;
            $mercancia->medida = $this->faker->randomDigit();
            $mercancia->unidadMedida = $unidadesMedida[$i]->unidadMedida;
            $mercancia->pais = $paises[$i]->pais;
            $mercancia->peso = $this->faker->randomDigit();
            $mercancia->save();

        }

        
    }
}
