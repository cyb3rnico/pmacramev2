<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//modelo importado
use App\Models\Categoria;

use App\Models\Producto;

class CategoriasController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth');
    // }
    
    public function getCategorias(){
        $categorias = Categoria::where('nombreCat','<>','Sin Categoría')->orderBy('nombreCat')->get();
        return $categorias;
    }

    public function filtrarCategorias(Request $request){
        $input = $request->all();
        $filtro = $input["filtro"];
        $productos = Producto::where("categoria", $filtro)->get();
        return $productos;
    }

    public function crearCategoria(Request $request){
        $input = $request->all();
        $categoria = new Categoria();
        $categoria->nombreCat = $input["nombreCat"];
        $categoria->registrarFecha();
        return $categoria;
    }

    public function obtenerPorId(Request $request){
        $input = $request->all();
        $id = $input["id"];
        $categoria = Categoria::findOrFail($id); 
        return $categoria;
    }

    public function actualizarCategoria(Request $request){
        $input = $request->all();
        $id = $input["id"];
        $categoria = Categoria::findOrFail($id);
        $categoria->nombreCat = $input["nombreCat"];

        $categoria->save();
        return $categoria;
    }

    public function eliminarCategoria(Request $request){
        $destinoId = Categoria::select('id')->where('nombreCat','=','Sin Categoría')->firstOrFail();
        //dd($destinoId->id);
        $input = $request->all();
        $id = $input["id"];
        Producto::where('categoria_id', $id)->update(['categoria_id' => $destinoId->id]);
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return "ok";
    }
}
