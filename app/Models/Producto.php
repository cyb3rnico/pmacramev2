<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';
    protected $fillable = ['cantidad'];
    
    // public function registrarFecha(){
    //     $this->fecha = new DateTime('NOW');
    // }

    public function categoria(){
        return $this->belongsTo("App\Models\Categoria"); // muchos productos pertenecen a una categoria
    }
    
    public function materiales(){
        return $this->belongsToMany("App\Models\Material");
    }

    public function ventas(){
        return $this->belongsToMany("App\Models\Venta"); // un producto puede tener muchas ventas
    }
}
