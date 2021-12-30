<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias';

    public function registrarFecha(){
        $this->fecha = new DateTime('NOW');
        $this->save();
    }

    public function productos(){
        return $this->hasMany("App\Models\Producto"); // una categoria tiene muchos productos
    }
}
