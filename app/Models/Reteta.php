<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reteta extends Model
{
    use HasFactory;

    protected $fillable=['user_id','titlu','descriere','tip_masa','durata_gatire','imagine','is_active','is_visible'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function continut(){
        return $this->hasMany(continutReteta::class);
    }

    public function pas(){
        return $this->hasMany(RecipeStep::class);
    }

    public function autor(){
        return $this->belongsTo(User::class,'id_autor');
    }

    public function review(){
        return $this->hasMany(Review::class);
    }

    public function categorie(){
        return $this->belongsTo(categorieReteta::class);
    }

    public function mese(){
        return $this->hasMany(Masa::class);
    }
}
