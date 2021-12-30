<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//importar categorias
use App\Http\Controllers\CategoriasController;

//importar productos
use App\Http\Controllers\ProductosController;
//importar contactos
use App\Http\Controllers\ContactosController;

//importar proveedores
use App\Http\Controllers\ProveedoresController;

//importar clientes
use App\Http\Controllers\ClientesController;

//importar materiales
use App\Http\Controllers\MaterialesController;
//importar ventas
use App\Http\Controllers\VentasController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::group(['middleware' => 'auth:api'], function (Request $request) {
//     return $request->user();
    
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::post("ventas/post", [VentasController::class, "crearVenta"]);
});

Route::post("productsTotal",[ProductosController::class, "calcularTotal"]);

//Para categorias
Route::get("categorias/get", [CategoriasController::class, "getCategorias"]);

Route::post("categorias/post", [CategoriasController::class, "crearCategoria"]);
Route::post("categorias/update", [CategoriasController::class, "actualizarCategoria"]);
Route::get("categorias/findById", [CategoriasController::class,"obtenerPorId"]);
Route::post("categorias/delete", [CategoriasController::class, "eliminarCategoria"]);

//Para productos
Route::get("productos/get", [ProductosController::class, "getProductos"]);
Route::get("productos/filtrar", [ProductosController::class, "filtrarProductos"]);
Route::get("productos/buscar", [ProductosController::class, "buscarProductos"]);

Route::post("productos/post", [ProductosController::class, "crearProducto"]);
Route::post("productos/update", [ProductosController::class, "actualizarProducto"]);
Route::get("productos/findById", [ProductosController::class,"obtenerPorId"]);
Route::post("productos/delete", [ProductosController::class, "eliminarProducto"]);

Route::get("productos/getByCategoria", [ProductosController::class, "getProductosByCategoria"]);

//Para proveedores
Route::get("proveedores/get", [ProveedoresController::class, "getProveedores"]);

Route::post("proveedores/post", [ProveedoresController::class, "crearProveedor"]);
Route::post("proveedores/update", [ProveedoresController::class, "actualizarProveedor"]);
Route::get("proveedores/findByRut", [ProveedoresController::class,"obtenerPorRut"]);
Route::post("proveedores/delete", [ProveedoresController::class, "eliminarProveedor"]);

//Para materiales
Route::get("materiales/get", [MaterialesController::class, "getMateriales"]);

Route::get("materiales/filtrar", [MaterialesController::class, "filtrarMateriales"]);


Route::post("materiales/post", [MaterialesController::class, "crearMaterial"]);
Route::post("materiales/update", [MaterialesController::class, "actualizarMaterial"]);
Route::get("materiales/findById", [MaterialesController::class,"obtenerPorId"]);
Route::post("materiales/delete", [MaterialesController::class, "eliminarMaterial"]);


//Para clientes
Route::get("clientes/get", [ClientesController::class, "getClientes"]);

Route::post("clientes/post", [ClientesController::class, "crearCliente"]);
Route::post("clientes/update", [ClientesController::class, "actualizarCliente"]);
Route::get("clientes/findByRut", [ClientesController::class,"obtenerPorRut"]);
Route::post("clientes/delete", [ClientesController::class, "eliminarCliente"]);

//Para Ventas
Route::get("ventas/get", [VentasController::class, "getVentas"]);

Route::get("ventas/filtrar", [VentasController::class, "filtrarVentas"]);

Route::post("ventas/update", [VentasController::class, "actualizarVenta"]);
Route::get("ventas/findByRut", [VentasController::class,"obtenerPorRut"]);
Route::post("ventas/delete", [VentasController::class, "eliminarVenta"]);