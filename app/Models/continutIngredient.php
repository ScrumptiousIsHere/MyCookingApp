<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class continutIngredient extends Model
{
    use HasFactory;

    protected $fillable=['ingredient_id','nutrient_id','cantitate'];

    public function nutrient(){
        return $this->belongsTo(Nutrient::class);
    }

    public function ingredient(){
        return $this->belongsTo(Ingredient::class);
    }

    public function categorie(){
        return $this->belongsTo(categoriiIngredient::class);
    }
}
