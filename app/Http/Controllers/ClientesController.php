<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use PDF;

class ClientesController extends Controller
{
    public function getClientes(){
        $clientes = Cliente::orderBy('nombre')->get();
        return $clientes;
    }

    public function filtrarClientes(Request $request){
        $input = $request->all();
        $filtro = $input["filtro"];
        $clientes = Cliente::where("material", $filtro)->get();
        return $clientes;
    }

    public function crearCliente(Request $request){
        $input = $request->all();
        $cliente = new Cliente();
        $cliente->rut = $input["rut"];
        $cliente->nombre = $input["nombre"];
        $cliente->apellidos = $input["apellidos"];
        $cliente->direccion = $input["direccion"];
        $cliente->email = $input["email"];
        $cliente->telefono = $input["telefono"];

        $cliente->save();
        return $cliente;
    }

    public function obtenerPorRut(Request $request){
        $input = $request->all();
        $rut= $input["rut"];
        $cliente = Cliente::findOrFail($rut); 
        return $cliente;
    }

    public function actualizarCliente(Request $request){
        $input = $request->all();
        $rut = $input["rut"];
        $cliente = Cliente::findOrFail($rut);
        $cliente->nombre = $input["nombre"];
        $cliente->apellidos = $input["apellidos"];
        $cliente->direccion = $input["direccion"];
        $cliente->email = $input["email"];
        $cliente->telefono = $input["telefono"];

        $cliente->save();
        return $cliente;
    }

    public function eliminarCliente(Request $request){
        $input = $request->all();
        $rut = $input["rut"];
        $cliente = Cliente::findOrFail($rut);
        $cliente->delete();
        return "ok";
    }

    public function descargarTablaClientes(){
        $tablaClientes = Cliente::orderBy('nombre')->get();
        $pdf = PDF::loadView('clientes.tabla-clientes',compact('tablaClientes'));
        $pdf->setPaper('letter','portrait');
        return $pdf->download('tabla-clientes.pdf');
    }
}
