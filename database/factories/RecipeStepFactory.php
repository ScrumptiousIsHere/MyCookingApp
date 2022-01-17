<?php

namespace Database\Factories;

use App\Models\RecipeStep;
use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\Types\Integer;

class RecipeStepFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RecipeStep::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Descriere'=>$this->faker->text(),
            'reteta_id'=>random_int(1,4),
            'nr_pas'=>random_int(1,10)
        ];
    }
}
