<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto;

use App\Models\Categoria;

use App\Models\Material;

use DateTime;

use PDF;

class ProductosController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth');
    // }

    public function calcularTotal(Request $request){
        $products = $request->products;
        $cantidad_productos = $request->cantidad_productos;
        $total = 0;
        for($i = 0; $i < count($products); $i++){
            $pro = Producto::find($products[$i]);
            $total = $total + ($cantidad_productos * $pro->precio);
        }
        return $total;

    }


    public function getProductosByCategoria(Request $request){
        $input = $request->all();
        $idCategoria = $input["idCategoria"];
        $categoria = Categoria::findOrFail($idCategoria); //404
        return $categoria->productos()->get(); // SELECT J.* FROM productos J JOIN categorias ON J.categoria=C.id WHERE C.id=1
    }

    public function getProductos(){
        //Funcion que va a buscar todos los productos que hay en la BD y las retorna
        $productos = Producto::all();
        foreach ($productos as $key => $producto) {
            $producto->categoria->nombreCat;
        }
        return $productos;
    }
    

    public function filtrarProductos(Request $request){
        $input = $request->all();
        $filtro = $input["filtro"];
        $productos = Producto::where("categoria_id", $filtro)->get();
        foreach ($productos as $key => $producto) {
            $producto->categoria->nombreCat;
        }
        return $productos;
    }

    public function buscarProductos(Request $request){
        $input = $request->all();
        $busqueda = $input["busqueda"];
        $productos = Producto::where("nombre", $busqueda)->get();
        // foreach ($productos as $key => $producto) {
        //     $producto->categoria->nombreCat;
        // }
        return $productos;
    }

    public function crearProducto(Request $request){
        //Funcion que registra un producto en la BD
        $input = $request->all();
        $producto = new Producto();
        $producto->nombre = $input["nombre"];
        $producto->categoria_id = $input["categoria_id"];
        $producto->cantidad_material = $input["cantidad_material"];
        $producto->descripcion = $input["descripcion"];
        $producto->cantidad = $input["cantidad"];
        $producto->precio = $input["precio"];
        $producto->fecha = new DateTime('NOW');
        $producto->save();
        $producto->materiales()->sync($input["materiales"]);

        for($i = 0; $i < count($input["materiales"]); $i++){
            $material = Material::findOrFail($input["materiales"][$i]);
            $cantidadNueva = ($material->stock - $input["cantidad_material"]);
            $material->update(["stock" => $cantidadNueva]);
        }
        
        return $producto;
    }

    public function obtenerPorId(Request $request){
        $input = $request->all();
        $id = $input["id"];
        $producto = Producto::with('materiales')->findOrFail($id); 
        return $producto;
    }

    public function actualizarProducto(Request $request){
        $input = $request->all();
        $id = $input["id"];
        $producto = Producto::findOrFail($id);
        $producto->nombre = $input["nombre"];
        $producto->categoria_id = $input["categoria_id"];
        $producto->descripcion = $input["descripcion"];
        $producto->cantidad = $input["cantidad"];
        $producto->precio = $input["precio"];
        $producto->fecha = new DateTime('NOW');
        $producto->save();
        // $producto->materiales()->sync($input["materiales"]);
        return $producto;
    }

    public function eliminarProducto(Request $request){
        $input = $request->all();
        $id = $input["id"];
        // $producto = Producto::findOrFail($id);
        // $producto->delete();

        $producto = Producto::find($id);
        $producto->find($id)->materiales()->detach();
        $producto->delete();

        return "ok";
    }

    public function moverProductosDeCategoria(int $origenId, int $destinoId){
       Producto::where('categoria_id', $origenId)->update(['categoria_id' => $destinoId]);
    }

    public function descargarTablaProductos(){
        $tablaProductos = Producto::with('categoria')->get();
        $pdf = PDF::loadView('productos.tabla-productos',compact('tablaProductos'));
        $pdf->setPaper('letter','portrait');
        return $pdf->download('tabla-productos.pdf');
    }
}
