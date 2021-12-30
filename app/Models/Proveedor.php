<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table = 'proveedores';
    protected $primaryKey = 'rut';
    public $incrementing = false;
    protected $keyType = 'string';

    public function materiales(){
        return $this->hasMany("App\Models\Material"); // un proveedor provee muchos materiales
    }
    
}
