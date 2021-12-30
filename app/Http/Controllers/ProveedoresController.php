<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use PDF;

class ProveedoresController extends Controller
{
    public function getProveedores(){
        $proveedores = Proveedor::orderBy('nombre')->get();
        return $proveedores;
    }

    public function filtrarProveedores(Request $request){
        $input = $request->all();
        $filtro = $input["filtro"];
        $proveedores = Proveedor::where("material", $filtro)->get();
        return $proveedores;
    }

    public function crearProveedor(Request $request){
        $input = $request->all();
        $proveedor = new Proveedor();
        $proveedor->rut = $input["rut"];
        $proveedor->nombre = $input["nombre"];
        $proveedor->apellidos = $input["apellidos"];
        $proveedor->direccion = $input["direccion"];
        $proveedor->email = $input["email"];
        $proveedor->telefono = $input["telefono"];


        $proveedor->save();
        return $proveedor;
    }

    public function obtenerPorRut(Request $request){
        $input = $request->all();
        $rut= $input["rut"];
        $proveedor = Proveedor::findOrFail($rut); 
        return $proveedor;
    }

    public function actualizarProveedor(Request $request){
        $input = $request->all();
        $rut = $input["rut"];
        $proveedor = Proveedor::findOrFail($rut);
        $proveedor->nombre = $input["nombre"];
        $proveedor->apellidos = $input["apellidos"];
        $proveedor->direccion = $input["direccion"];
        $proveedor->email = $input["email"];
        $proveedor->telefono = $input["telefono"];

        $proveedor->save();
        return $proveedor;
    }

    public function eliminarProveedor(Request $request){
        $input = $request->all();
        $rut = $input["rut"];
        $proveedor = Proveedor::findOrFail($rut);
        $proveedor->delete();
        return "ok";
    }

    public function descargarTablaProveedores(){
        $tablaProveedores = Proveedor::orderBy('nombre')->get();
        $pdf = PDF::loadView('proveedores.tabla-proveedores',compact('tablaProveedores'));
        $pdf->setPaper('letter','portrait');
        return $pdf->download('tabla-proveedores.pdf');
    }
}
