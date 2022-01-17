<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeStep extends Model
{
    use HasFactory;

    protected $fillable=['user_id','titlu','descriere','tip_masa','durata_gatire','imagine'];

    public function reteta(){
        return $this->belongsTo(Reteta::class);
    }

}
