<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\SendingSalesEmail;
use DateTime;
use Mail;
use PDF;

class VentasController extends Controller
{
    public function __construct()
    {

    }

    public function getVentas(){
        $ventas = Venta::with("productos")->get();
        foreach ($ventas as $key => $venta) {
            $venta->cliente->rut;
        }
        // foreach ($ventas as $key => $venta) {
        //     $venta->producto->nombre;
        // }
        return $ventas;
    }

    // public function filtrarVentas(Request $request){
    //     $input = $request->all();
    //     $filtro = $input["filtro"];
    //     $ventas = Venta::with('productos','cliente')->WhereHas('productos', function ($query) use($filtro){
    //         $query->where('producto_id', $filtro);
    //     })->get();
    //     return $ventas;
    // }

    public function filtrarVentas(Request $request){
        $input = $request->all();
        $filtro = $input["filtro"];
        $ventas = Venta::with("productos","cliente")->where("cliente_rut", $filtro)->get();
        return $ventas;
    }

    public function crearVenta(Request $request){
        $total = 0;
        $input = $request->all();
        $venta = new Venta();
        $venta->cliente_rut = $input["cliente_rut"];
        $venta->cantidad = $input["cantidad"];
        $venta->fecha = new DateTime('NOW');
        for($i = 0; $i < count($input["producto_id"]); $i++){
            $product = Producto::findOrFail($input["producto_id"][$i]);
            $total = $total + ($input["cantidad"] * $product->precio);
        }
        $venta->total = $total;
        $venta->save();
        $venta->productos()->sync($input["producto_id"]);
        for($i = 0; $i < count($input["producto_id"]); $i++){
            $product = Producto::findOrFail($input["producto_id"][$i]);
            $cantidad = ($product->cantidad - $input["cantidad"]);
            $product->update(["cantidad" => $cantidad]);
        }
        $response = Cliente::find($input['cliente_rut']);
        $usuario = auth()->user()->nombre;
        $rol =  auth()->user()->rol->nombre;
        Mail::to($response->email)->send(new SendingSalesEmail($response,$venta,$usuario,$rol));
        return $venta;
    }

    public function obtenerPorId(Request $request){
        $input = $request->all();
        $id = $input["id"];
        $venta = Venta::findOrFail($id); 
        return $venta;
    }

    public function actualizarVenta(Request $request){
        $input = $request->all();
        $id = $input["id"];
        $venta = Venta::findOrFail($id);
        $venta->producto = $input["producto"];
        $venta->cliente = $input["cliente"];
        $venta->cantidad = $input["cantidad"];
        $venta->total = $input["total"];
        $venta->registrarFecha();
        return $venta;
    }

    public function eliminarVenta(Request $request){
        $input = $request->all();
        $id = $input["id"];

        $venta = Venta::find($id);
        $venta->find($id)->productos()->detach();
        $venta->delete();

        // $venta = Venta::findOrFail($id);
        // $venta->delete();
        return "ok";
    }

    private function getTabla(){
        $tablaVentas = collect();
        foreach(Venta::all() as $venta){
            $tablaVentas->add([
                'id' => $venta->id,
                'producto_id' => $venta->producto_id,
                'cliente_rut' => $venta->cliente_rut,
                'cantidad' => $venta->cantidad,
                'total' => $venta->total,
                'fecha' => $venta->fecha,
            ]);            
        }

        return $tablaVentas->values()->all();
    }

    public function tablaVentas(){       
        $tablaVentas = $this->getTabla();
        return view('ventas.tabla-ventas',compact('tablaVentas'));
    }

    public function descargarTablaVentas(){
        $tablaVentas = Venta::with("productos","cliente")->get();
        $sum_total = Venta::with("productos","cliente")->get()->sum('total');
        //var_export($tablaVentas); die;
        $pdf = PDF::loadView('ventas.tabla-ventas',compact('tablaVentas','sum_total'));
        $pdf->setPaper('letter','portrait');
        return $pdf->download('tabla-ventas.pdf');
    }
}
