<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use PDF;

class MaterialesController extends Controller
{
    public function getMateriales(){
        //Funcion que va a buscar todos los materiales que hay en la BD y las retorna
        $materiales = Material::with("proveedor")->get();
        return $materiales;
    }


    public function filtrarMateriales(Request $request){
        $input = $request->all();
        $filtro = $input["filtro"];
        $materiales = Material::with("proveedor")->where("rut_proveedor", $filtro)->get();
        return $materiales;
    }

    public function crearMaterial(Request $request){
        //Funcion que registra un material en la BD
        $input = $request->all();
        $material = new Material();
        $material->nombre = $input["nombre"];
        $material->descripcion = $input["descripcion"];
        $material->rut_proveedor = $input["rut_proveedor"];
        $material->unidad_medida = $input["unidad_medida"];
        $material->stock = intval($input["stock_maximo"]) - intval($input["stock_minimo"]);
        $material->stock_minimo = $input["stock_minimo"];
        $material->stock_maximo = $input["stock_maximo"];
        $material->precio = $input["precio"];
        $material->registrarFecha();

        return $material;
    }

    public function obtenerPorId(Request $request){
        $input = $request->all();
        $id = $input["id"];
        $material = Material::findOrFail($id); 
        return $material;
    }

    public function actualizarMaterial(Request $request){
        $input = $request->all();
        $id = $input["id"];
        $material = Material::findOrFail($id);
        $material->nombre = $input["nombre"];
        $material->descripcion = $input["descripcion"];
        $material->rut_proveedor = $input["rut_proveedor"];
        $material->unidad_medida = $input["unidad_medida"];
        $material->stock = intval($input["stock_maximo"]) - intval($input["stock_minimo"]);
        $material->stock_minimo = $input["stock_minimo"];
        $material->stock_maximo = $input["stock_maximo"];
        $material->precio = $input["precio"];
        $material->registrarFecha();

        return $material;
    }

    public function eliminarMaterial(Request $request){
        $input = $request->all();
        $id = $input["id"];
        $material = Material::findOrFail($id);
        $material->delete();

        // $material = Material::find($id);
        // $material->find($id)->productos()->detach();
        // $material->delete();
        return "ok";
    }

    public function descargarTablaMateriales(){
        $tablaMateriales = Material::with("proveedor")->get();
        $pdf = PDF::loadView('materiales.tabla-materiales',compact('tablaMateriales'));
        $pdf->setPaper('letter','portrait');
        return $pdf->download('tabla-materiales.pdf');
    }
}
