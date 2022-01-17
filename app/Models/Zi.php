<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zi extends Model
{
    use HasFactory;

    protected $fillable=['nume'];

    public function mese(){
        return $this->hasMany(Masa::class);
    }
}
