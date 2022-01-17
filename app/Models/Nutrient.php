<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nutrient extends Model
{
    use HasFactory;

    protected $fillable=['nume','calorii','UM'];

    public function utilizari(){
        return $this->hasMany(continutIngredient::class);
    }
}
