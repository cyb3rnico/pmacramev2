<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTime;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'venta';
    protected $fillable = ['nombre'];
    
    // public function registrarFecha(){
    //     $this->fecha = new DateTime('NOW');
    //     $this->save();
    // }

    public function cliente(){
        return $this->belongsTo('App\Models\Cliente'); // muchas ventas pertenecen a un cliente
    }

    public function productos(){
        return $this->belongsToMany("App\Models\Producto"); // muchas ventas puede tener un producto
    }
}
