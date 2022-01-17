<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Reteta;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'prenume',
        'password',
        'data_nasterii',
        'greutate',
        'inaltime',
        'grad_activitate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'first_time',
        'is_admin'
    ];

    protected $table='users';
    public $timestamps=false;
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function setAtributActivitate($value){
        $this->attributes['grad_activitate'] = $value < 5 ? $value : 5;
        $this->attributes['grad_activitate'] = $value > 1 ? $value : 1;
    }

    public function reteta(){
        return $this->hasMany(Reteta::class);
    }

    public function mese(){
        return $this->hasMany(Masa::class);
    }
}
