<?php

namespace Database\Factories;

use App\Models\Mensajeria;
use Illuminate\Database\Eloquent\Factories\Factory;

class MensajeriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mensajeria::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mensajeria' => $this->faker->word(), 
            'logo' => $this->faker->imageUrl(), 
        ];
    }
}
