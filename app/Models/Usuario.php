<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

use DateTime;

class Usuario extends Authenticable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'usuarios';

    public function registrarUltimoLogin(){
        $this->ultimo_login = new DateTime('NOW');
        $this->save();
    }

    public function rol(){
        return $this->belongsTo('App\Models\Rol');
    }

    /**
     * The attributes that should be hidden for arrays.
     * @author Niolas
     * @created 2021-12-19
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}