<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categorieReteta extends Model
{
    use HasFactory;

    protected $fillable=['tip'];

    public function retete(){
        return $this->hasMany(Reteta::class);
    }
}
