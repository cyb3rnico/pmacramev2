<?php

use Illuminate\Support\Facades\Route;

//incluimos los controladores en este archivo
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesController;

use App\Http\Controllers\VentasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\MaterialesController;
use App\Http\Controllers\ProductosController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// })->middleware('auth');

// Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register.index');
// Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Route::get('/login', [SessionsController::class, 'create'])->middleware('guest')->name('login.index');
// Route::post('/login', [SessionsController::class, 'store'])->name('login.store');
// Route::get('/logout', [SessionsController::class, 'destroy'])->middleware('auth')->name('login.destroy');

// Route::get('/admin', [AdminController::class, 'index'])->middleware('auth.admin')->name('admin.index');

Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('/login',[HomeController::class,'login'])->name('home.login');

Route::post('/usuarios/login',[UsuariosController::class,'login'])->name('usuarios.login');
Route::get('/usuarios/logout',[UsuariosController::class,'logout'])->name('usuarios.logout');
Route::post('/usuarios/{usuario}/activar',[UsuariosController::class,'activar'])->name('usuarios.activar');
Route::resource('/usuarios',UsuariosController::class);

Route::get('/roles',[RolesController::class,'index'])->name('roles.index');
Route::post('/roles',[RolesController::class,'store'])->name('roles.store');
Route::put('/roles/{rol}',[RolesController::class,'update'])->name('roles.update');
Route::delete('/roles/{rol}',[RolesController::class,'destroy'])->name('roles.destroy');

//Vistas

// Route::view("/admin/home", "admin/home")->middleware('auth')->name("admin/home");

// Route::view("/home_user", "home_user")->middleware('auth')->name("home_user");

Route::view("/categorias/agregar_categoria", "categorias/agregar_categoria")->middleware('auth')->name("categorias/agregar_categoria");
Route::view("/categorias/ver_categorias", "categorias/ver_categorias")->middleware('auth')->name("categorias/ver_categorias");

Route::view("/productos/agregar_producto", "productos/agregar_producto")->middleware('auth')->name("productos/agregar_producto");
Route::view("/productos/ver_productos", "productos/ver_productos")->middleware('auth')->name("productos/ver_productos");

Route::view("/materiales/agregar_material", "materiales/agregar_material")->middleware('auth')->name("materiales/agregar_material");
Route::view("/materiales/ver_materiales", "materiales/ver_materiales")->middleware('auth')->name("materiales/ver_materiales");

Route::view("/proveedores/agregar_proveedor", "proveedores/agregar_proveedor")->middleware('auth')->name("proveedores/agregar_proveedor");
Route::view("/proveedores/ver_proveedores", "proveedores/ver_proveedores")->middleware('auth')->name("proveedores/ver_proveedores");

Route::view("/clientes/agregar_cliente", "clientes/agregar_cliente")->middleware('auth')->name("clientes/agregar_cliente");
Route::view("/clientes/ver_clientes", "clientes/ver_clientes")->middleware('auth')->name("clientes/ver_clientes");

Route::view("/ventas/agregar_venta", "ventas/agregar_venta")->middleware('auth')->name("ventas/agregar_venta");
Route::view("/ventas/ver_ventas", "ventas/ver_ventas")->middleware('auth')->name("ventas/ver_ventas");

//PDF
Route::get('/ventas/tabla-ventas',[VentasController::class,'tablaVentas'])->name('ventas.tabla-ventas');
Route::get('/ventas/descargar-tabla-ventas',[VentasController::class,'descargarTablaVentas'])->name('ventas.descargar-tabla-ventas');
Route::get('/clientes/descargar-tabla-clientes',[ClientesController::class,'descargarTablaClientes'])->name('clientes.descargar-tabla-clientes');
Route::get('/proveedores/descargar-tabla-proveedores',[ProveedoresController::class,'descargarTablaProveedores'])->name('proveedores.descargar-tabla-proveedores');
Route::get('/materiales/descargar-tabla-materiales',[MaterialesController::class,'descargarTablaMateriales'])->name('materiales.descargar-tabla-materiales');
Route::get('/productos/descargar-tabla-productos',[ProductosController::class,'descargarTablaProductos'])->name('productos.descargar-tabla-productos');