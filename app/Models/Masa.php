<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masa extends Model
{
    use HasFactory;

    protected $fillable=['reteta_id','user_id','masa_id'];

    public function zi(){
        return $this->belongsTo(Zi::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reteta(){
        return $this->belongsTo(Reteta::class);
    }
}
