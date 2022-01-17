<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class continutReteta extends Model
{
    use HasFactory;
    protected $fillable=['id_reteta','id_ingredient','cantitate'];

    public function reteta(){
        return $this->belongsTo(Reteta::class);
    }

    public function ingredient(){
        return $this->belongsTo(Ingredient::class);
    }

}
