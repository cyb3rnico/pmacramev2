<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $primaryKey = 'rut';
    public $incrementing = false;
    protected $keyType = 'string';

    public function ventas(){
        return $this->hasMany(Ventas::class); // un cliente posee muchas compras (ventas)
    }
}
