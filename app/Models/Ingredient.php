<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable=['nume','UM','categorii_ingredient_id','user_id','is_active','is_visible'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function continut(){
        return $this->hasMany(continutIngredient::class);
    }

    public function utilizari(){
        return $this->hasMany(continutReteta::class);
    }

    public function categorie(){
        return $this->belongsTo(categoriiIngredient::class);
    }
}
