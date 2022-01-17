<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorit extends Model
{
    use HasFactory;

    protected $fillable=['user_id','reteta_id','is_active'];


}
