<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable=['user_id','reteta_id','report_categories_id'];

    public function motiv(){
        return $this->belongsTo(ReportCategorie::class);
    }

    public function categorie(){
        return $this->belongsTo(ReportCategorie::class);
    }
}
