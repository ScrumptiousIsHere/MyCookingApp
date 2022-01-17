<?php

namespace Database\Factories;

use App\Models\Nutrient;
use Illuminate\Database\Eloquent\Factories\Factory;

class NutrientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Nutrient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nume'=>$this->faker->word(),
            'calorii'=>$this->faker->numberBetween(4,9),
            'UM'=>$this->faker->randomLetter()
        ];
    }
}
