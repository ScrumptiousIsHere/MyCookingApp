<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable=['continut','nota','user_id','reteta_id','is_active'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reteta(){
        return $this->belongsTo(Reteta::class);
    }
}
