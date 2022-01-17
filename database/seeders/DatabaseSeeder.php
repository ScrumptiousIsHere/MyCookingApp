<?php

namespace Database\Seeders;


use App\Models\categoriiIngredient;
use App\Models\continutReteta;
use App\Models\Ingredient;
use App\Models\continutIngredient;
use App\Models\Nutrient;
use App\Models\Post;
use App\Models\reportCategorie;
use App\Models\Reteta;
use App\Models\User;
use App\Models\RecipeStep;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {



        $user = User::factory()->create(['name'=>'Ionescu','prenume'=>'Gruia']);




        Nutrient::factory()->create([
            'nume'=>'Proteina',
            'calorii'=>4,
            'UM'=>'g'
        ]);
        Nutrient::factory()->create([
            'nume'=>'Carbohidrat',
            'calorii'=>4,
            'UM'=>'g'
        ]);
        Nutrient::factory()->create([
            'nume'=>'Grasime',
            'calorii'=>9,
            'UM'=>'g'
        ]);
        Nutrient::factory()->create([
            'nume'=>'Alcool',
            'calorii'=>7,
            'UM'=>'g'
        ]);
        Nutrient::factory()->create([
            'nume'=>'Sare',
            'calorii'=>0,
            'UM'=>'mg'
        ]);
        Nutrient::factory()->create([
            'nume'=>'Grasimi Staturate',
            'calorii'=>9,
            'UM'=>'g'
        ]);
        Nutrient::factory()->create([
            'nume'=>'Zaharuri',
            'calorii'=>4,
            'UM'=>'g'
        ]);
        Nutrient::factory()->create([
            'nume'=>'Fibre',
            'calorii'=>0,
            'UM'=>'g'
        ]);




        categoriiIngredient::factory()->create([
            'tip'=>'mezeluri'
        ]);
        categoriiIngredient::factory()->create([
            'tip'=>'carne'
        ]);
        categoriiIngredient::factory()->create([
            'tip'=>'peste'
        ]);
        categoriiIngredient::factory()->create([
            'tip'=>'legume/fructe'
        ]);
        categoriiIngredient::factory()->create([
            'tip'=>'seminte/nuci'
        ]);
        categoriiIngredient::factory()->create([
            'tip'=>'cereale'
        ]);
        categoriiIngredient::factory()->create([
            'tip'=>'condimente'
        ]);
        categoriiIngredient::factory()->create([
            'tip'=>'lactate'
        ]);
        categoriiIngredient::factory()->create([
            'tip'=>'branzeturi'
        ]);
        categoriiIngredient::factory()->create([
            'tip'=>'dulciuri'
        ]);
        categoriiIngredient::factory()->create([
            'tip'=>'bauturi'
        ]);
        categoriiIngredient::factory()->create([
            'tip'=>'semipreparate'
        ]);
        categoriiIngredient::factory()->create([
            'tip'=>'ready-to-eat'
        ]);
        categoriiIngredient::factory()->create([
            'tip'=>'uleioase'
        ]);
        categoriiIngredient::factory()->create([
            'tip'=>'sosuri'
        ]);
        categoriiIngredient::factory()->create([
            'tip'=>'paine'
        ]);
        categoriiIngredient::factory()->create([
            'tip'=>'gustari'
        ]);
        categoriiIngredient::factory()->create([
            'tip'=>'suplimente'
        ]);
        categoriiIngredient::factory()->create([
            'tip'=>'altele'
        ]);





        ReportCategorie::factory()->create([
           'tip'=>'categorie-incompatibila'
        ]);
        ReportCategorie::factory()->create([
            'tip'=>'ingrediente-invalide'
        ]);
        ReportCategorie::factory()->create([
            'tip'=>'reteta-necorespunzatoare'
        ]);







        Ingredient::factory()->create([
           'nume'=>'Lapte Pilos 1.5% grasime',
            'UM'=>'ml',
            'categorii_ingredient_id'=>8,
            'user_id'=>1,
            'is_active'=>true
        ]);
        continutIngredient::factory()->create([
            'ingredient_id'=>1,
            'nutrient_id'=>1,
            'cantitate'=>3.1
        ]);
        continutIngredient::factory()->create([
            'ingredient_id'=>1,
            'nutrient_id'=>2,
            'cantitate'=>4.5
        ]);
        continutIngredient::factory()->create([
            'ingredient_id'=>1,
            'nutrient_id'=>7,
            'cantitate'=>4.5
        ]);
        continutIngredient::factory()->create([
            'ingredient_id'=>1,
            'nutrient_id'=>3,
            'cantitate'=>2
        ]);
        continutIngredient::factory()->create([
            'ingredient_id'=>1,
            'nutrient_id'=>6,
            'cantitate'=>1
        ]);





        Ingredient::factory()->create([
            'nume'=>'Cereale Nesquik',
            'UM'=>'g',
            'categorii_ingredient_id'=>6,
            'user_id'=>1,
            'is_active'=>true
        ]);
        continutIngredient::factory()->create([
            'ingredient_id'=>2,
            'nutrient_id'=>1,
            'cantitate'=>8.4
        ]);
        continutIngredient::factory()->create([
            'ingredient_id'=>2,
            'nutrient_id'=>2,
            'cantitate'=>75.8
        ]);
        continutIngredient::factory()->create([
            'ingredient_id'=>2,
            'nutrient_id'=>3,
            'cantitate'=>1.7
        ]);
        continutIngredient::factory()->create([
            'ingredient_id'=>2,
            'nutrient_id'=>7,
            'cantitate'=>24.9
        ]);
        continutIngredient::factory()->create([
            'ingredient_id'=>2,
            'nutrient_id'=>6,
            'cantitate'=>0.6
        ]);
        continutIngredient::factory()->create([
            'ingredient_id'=>2,
            'nutrient_id'=>8,
            'cantitate'=>8.7
        ]);
        continutIngredient::factory()->create([
            'ingredient_id'=>2,
            'nutrient_id'=>5,
            'cantitate'=>440
        ]);



        Reteta::factory()->create([
            'user_id'=>1,
            'titlu'=>'cereale cu lapte',
            'descriere'=>'Se pun cerealele peste lapte',
            'durata_gatire'=>'2',
            'imagine'=>'cereale.jpg',
            'tip_masa'=>'mic-dejun',
            'is_active'=>true,
            'is_visible'=>true
        ]);
        continutReteta::factory()->create([
            'reteta_id'=>1,
            'ingredient_id'=>1,
            'cantitate'=>300
        ]);
        continutReteta::factory()->create([
            'reteta_id'=>1,
            'ingredient_id'=>2,
            'cantitate'=>100
        ]);

        RecipeStep::factory()->create([
           'reteta_id'=>1,
           'nr_pas'=>1,
           'Descriere'=>'Se pun cerealele peste lapte'
        ]);

        RecipeStep::factory()->create([
            'reteta_id'=>1,
            'nr_pas'=>2,
            'Descriere'=>'Pofta buna!'
        ]);



//        $personal=Category::create(['nume'=>'Personal','tip'=>'personal']);
//        $work=Category::create(['nume'=>'Work','tip'=>'work']);
//        $hobbies=Category::create(['nume'=>'Hobbies','tip'=>'hobbies']);
//
//        Post::create(['user_id'=>$user->id,'category_id'=>$personal->id,'titlu'=>'My Family Post','slug'=>'my-personal-post','descriere'=>'Descrierea postarii mele','continut'=>'Lorem ipsum dolor sit amet.']);
//        Post::create(['user_id'=>$user->id,'category_id'=>$work->id,'titlu'=>'My Work Post','slug'=>'my-work-post','descriere'=>'Descrierea postarii mele','continut'=>'Lorem ipsum dolor sit amet.']);
//        Post::create(['user_id'=>$user->id,'category_id'=>$hobbies->id,'titlu'=>'My Hobbies Post','slug'=>'my-hobbies-post','descriere'=>'Descrierea postarii mele','continut'=>'Lorem ipsum dolor sit amet.']);
//        Post::create(['user_id'=>$user->id,'category_id'=>$personal->id,'titlu'=>'My Family Post 2','slug'=>'my-personal-post-2','descriere'=>'Descrierea postarii mele','continut'=>'Lorem ipsum dolor sit amet.']);

    }
}
