<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoriiIngredient extends Model
{
    use HasFactory;

    protected $fillable=['tip'];

    public function ingrediente(){
        return $this->hasMany(Ingredient::class);
    }


}
