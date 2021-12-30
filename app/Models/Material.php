<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class Material extends Model
{
    use HasFactory;
    protected $table = 'materials';
    protected $fillable = ['stock'];

    public function registrarFecha(){
        $this->fecha = new DateTime('NOW');
        $this->save();
    }

    public function productos(){
        return $this->belongsToMany("App\Models\Producto");
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'rut_proveedor');
    }
}
