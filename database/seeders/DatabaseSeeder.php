<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\{Schema,DB};
use DateTime,DateInterval;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $user = new User;
        // $user->name = 'Administrador';
        // $user->email = 'admin@pristinamacrame.cl';
        // $user->password = '123456';
        // $user->role = 'admin';

        // $user->save();

        $tablas = ['categorias','productos','roles','usuarios','proveedores','materials','clientes', 'material_producto','venta','producto_venta'];
        Schema::disableForeignKeyConstraints();
        foreach($tablas as $tabla){
            DB::table($tabla)->truncate();
        }
        Schema::enableForeignKeyConstraints();
        
        //Categorías
        $categorias = [
            ['nombreCat'=>'Sin Categoría'],
            ['nombreCat' => 'Carteras'],
            ['nombreCat' => 'Colgadores'],
            ['nombreCat' => 'Espejos'],
            ['nombreCat' => 'Murales'],
            ['nombreCat' => 'Plumas'],
            ['nombreCat' => 'Posavasos'],
            ['nombreCat' => 'Repisas'],
        ];

        foreach($categorias as $categoria){
            DB::table('categorias')->insert([
                'nombreCat' => $categoria['nombreCat'],
            ]);
        }


        // Roles
        $roles = [
            ['nombre'=>'Administrador'], 
            ['nombre'=>'Coordinador'],
            ['nombre'=>'Asistente'],
            ['nombre'=>'Empleado'],
        ];

        foreach($roles as $rol){
            DB::table('roles')->insert([
                'nombre' => $rol['nombre'],
                'created_at' => new DateTime('NOW')
            ]);
        }

        // Usuarios
        $usuarios = [
            ['email'=>'pristina@macrame.cl','password'=>'$2y$10$N08krgw4r9JjM0lFIrWb8OnGEmWXd5LyFKsV9yBEucw0M7APk5iZK','nombre' => 'Romyna','activo' => 1,'rol_id' => 1],
            ['email'=>'coordinador@macrame.cl', 'password'=>'$2y$10$N08krgw4r9JjM0lFIrWb8OnGEmWXd5LyFKsV9yBEucw0M7APk5iZK','nombre' => 'Kevin','activo' => 1,'rol_id' => 2],
            ['email'=>'asistente@macrame.cl', 'password'=>'$2y$10$N08krgw4r9JjM0lFIrWb8OnGEmWXd5LyFKsV9yBEucw0M7APk5iZK','nombre' => 'Sean','activo' => 1,'rol_id' => 3],
            ['email'=>'empleado@macrame.cl', 'password'=>'$2y$10$N08krgw4r9JjM0lFIrWb8OnGEmWXd5LyFKsV9yBEucw0M7APk5iZK','nombre' => 'Chulupin','activo' => 1,'rol_id' => 4],
        ];

        foreach($usuarios as $usuario){
            DB::table('usuarios')->insert([
                'email' => $usuario['email'],
                'password' => $usuario['password'],
                'nombre' => $usuario['nombre'],
                'activo' => $usuario['activo'],
                'rol_id' => $usuario['rol_id']
            ]);
        }

        // Productos
        $productos = [
            ['nombre'=>'Espejo 25 a 35 cm','categoria_id'=>4,'cantidad_material' => 2, 'descripcion' => '<p><img src="https://i.imgur.com/otb99sp.png\" /></p>','cantidad' => 8,'precio' => 15000],
            ['nombre'=>'Mural 80x80', 'categoria_id'=>5,'cantidad_material' => 2,'descripcion' => '<p><img src="https://i.imgur.com/isPOXjt.png\" /></p>','cantidad' => 9,'precio' => 20000],
            ['nombre'=>'Cartera 25x14', 'categoria_id'=>2,'cantidad_material' => 2,'descripcion' => '<p><img src="https://i.imgur.com/D7CAmDq.png\" /></p>','cantidad' => 9,'precio' => 35990],
            ['nombre'=>'Colgador de maceta', 'categoria_id'=>2,'cantidad_material' => 2,'descripcion' => '<p><img src="https://i.imgur.com/jwii2TU.png\" /></p>','cantidad' => 2,'precio' => 20000],
            ['nombre'=>'Plumas XL', 'categoria_id'=>6,'cantidad_material' => 2,'descripcion' => '<p><img src="https://i.imgur.com/iLxo9J2.png\" /></p>','cantidad' => 7,'precio' => 7000],
            ['nombre'=>'Posavasos', 'categoria_id'=>7,'cantidad_material' => 2,'descripcion' => '<p><img src="https://i.imgur.com/igYSpu8.png\" /></p>','cantidad' => 8,'precio' => 3000],
            ['nombre'=>'Repisa', 'categoria_id'=>8,'cantidad_material' => 2,'descripcion' => '<p><img src="https://i.imgur.com/L3V720Q.png\" /></p>','cantidad' => 3,'precio' => 30000],
        ];

        foreach($productos as $producto){
            DB::table('productos')->insert([
                'nombre' => $producto['nombre'],
                'categoria_id' => $producto['categoria_id'],
                'cantidad_material' => $producto['cantidad_material'],
                'descripcion' => $producto['descripcion'],
                'cantidad' => $producto['cantidad'],
                'precio' => $producto['precio']
            ]);
        }

        


        // Proveedores
        $proveedores = [
            ['rut'=>'52.003.179-0','nombre'=>'Trenzaduría Francisco Alejandro','apellidos' => 'Fraile Reyes','direccion' => 'VICTOR MANUEL 1879, SANTIAGO','email' => 'contacto@trenzaduriafraile.cl','telefono' => '+56222555124'],
            ['rut'=>'7.807.700-k', 'nombre'=>'Mano','apellidos' => 'Manitas','direccion' => 'Irarrázaval 3601, Ñuñoa, Región Metropolitana','email' => 'contacto@manomanitas.cl','telefono' => '+569'],
        ];

        foreach($proveedores as $proveedor){
            DB::table('proveedores')->insert([
                'rut' => $proveedor['rut'],
                'nombre' => $proveedor['nombre'],
                'apellidos' => $proveedor['apellidos'],
                'direccion' => $proveedor['direccion'],
                'email' => $proveedor['email'],
                'telefono' => $proveedor['telefono'],
            ]);
        }

        // Clientes

        $clientes = [
            ['rut'=>'20.483.093-2','nombre'=>'Nicolás','apellidos' => 'Astudillo Díaz','direccion' => 'Quilpué','email' => 'nicolas.joaquin.cars@gmail.com','telefono' => '+569'],
            ['rut'=>'3.308.743-8', 'nombre'=>'Enrique','apellidos' => 'Astudillo Mura','direccion' => 'Concón','email' => 'muone1@hotmail.com','telefono' => '+569'],
            ['rut'=>'9.224.171-8', 'nombre'=>'Ana','apellidos' => 'Diaz Fernández','direccion' => 'Quilpué','email' => 'anamaria_592_@hotmail.com','telefono' => '+569'],
        ];

        foreach($clientes as $cliente){
            DB::table('clientes')->insert([
                'rut' => $cliente['rut'],
                'nombre' => $cliente['nombre'],
                'apellidos' => $cliente['apellidos'],
                'direccion' => $cliente['direccion'],
                'email' => $cliente['email'],
                'telefono' => $cliente['telefono'],
            ]);
        }
        
        //Materiales
        $materiales = [
            ['id'=>1,'nombre'=>'Palos de  50 cm - 60 cm','descripcion'=>'50cm o 60cm','rut_proveedor'=>'7.807.700-k','unidad_medida'=>'cm','stock'=>18,'stock_minimo'=>10,'stock_maximo'=>28,'precio'=>1000],
            ['id'=>2,'nombre'=>'Palos de pino','descripcion'=>'40cm','rut_proveedor'=>'7.807.700-k','unidad_medida'=>'cm','stock'=>20,'stock_minimo'=>5,'stock_maximo'=>25,'precio'=>1500],
            ['id'=>3,'nombre'=>'Palos de canelo','descripcion'=>'40cm','rut_proveedor'=>'7.807.700-k','unidad_medida'=>'cm','stock'=>19,'stock_minimo'=>5,'stock_maximo'=>24,'precio'=>1000],
            ['id'=>4,'nombre'=>'Palos de arrayan','descripcion'=>'50cm','rut_proveedor'=>'7.807.700-k','unidad_medida'=>'cm','stock'=>23,'stock_minimo'=>5,'stock_maximo'=>24,'precio'=>500],
            ['id'=>5,'nombre'=>'Espejos de 25 cm - 30 cm','descripcion'=>'25 cm - 30 cm','rut_proveedor'=>'7.807.700-k','unidad_medida'=>'cm','stock'=>15,'stock_minimo'=>3,'stock_maximo'=>18,'precio'=>490],
            ['id'=>6,'nombre'=>'Cuerda de algodon peinado','descripcion'=>'4mm','rut_proveedor'=>'52.003.179-0','unidad_medida'=>'mm','stock'=>27,'stock_minimo'=>1,'stock_maximo'=>28,'precio'=>200],
            ['id'=>7,'nombre'=>'Cuerda torcida','descripcion'=>'4mm','rut_proveedor'=>'52.003.179-0','unidad_medida'=>'mm','stock'=>13,'stock_minimo'=>6,'stock_maximo'=>19,'precio'=>1300],
            ['id'=>8,'nombre'=>'Cuerda trenzada','descripcion'=>'4mm','rut_proveedor'=>'52.003.179-0','unidad_medida'=>'mm','stock'=>7,'stock_minimo'=>7,'stock_maximo'=>14,'precio'=>1990],
            ['id'=>9,'nombre'=>'Anilina color azul 25 grs','descripcion'=>'Teñir las cuerdas','rut_proveedor'=>'7.807.700-k','unidad_medida'=>'grs','stock'=>11,'stock_minimo'=>8,'stock_maximo'=>19,'precio'=>2200],
            ['id'=>10,'nombre'=>'Anilina color salmón 25 grs','descripcion'=>'Teñir lps nudos','rut_proveedor'=>'7.807.700-k','unidad_medida'=>'grs','stock'=>5,'stock_minimo'=>9,'stock_maximo'=>14,'precio'=>2200],
            ['id'=>11,'nombre'=>'Anilinas de 10 colores 25 grs','descripcion'=>'25 grs c/u','rut_proveedor'=>'7.807.700-k','unidad_medida'=>'grs','stock'=>8,'stock_minimo'=>7,'stock_maximo'=>15,'precio'=>220],
        ];

        foreach($materiales as $material){
            DB::table('materials')->insert([
                'id' => $material['id'],
                'nombre' => $material['nombre'],
                'descripcion' => $material['descripcion'],
                'rut_proveedor' => $material['rut_proveedor'],
                'unidad_medida' => $material['unidad_medida'],
                'stock' => $material['stock'],
                'stock_minimo' => $material['stock_minimo'],
                'stock_maximo' => $material['stock_maximo'],
                'precio' => $material['precio'],
                'fecha' => new DateTime('NOW')
            ]);
        }

        // Material - Producto
        $materiales_productos = [
            ['id'=>5,'material_id'=>6,'producto_id'=>2],
            ['id'=>6,'material_id'=>8,'producto_id'=>2],
            ['id'=>7,'material_id'=>11,'producto_id'=>2],
            ['id'=>8,'material_id'=>5,'producto_id'=>1],
            ['id'=>9,'material_id'=>6,'producto_id'=>1],
            ['id'=>10,'material_id'=>6,'producto_id'=>3],
            ['id'=>11,'material_id'=>8,'producto_id'=>3],
            ['id'=>12,'material_id'=>7,'producto_id'=>4],
            ['id'=>13,'material_id'=>8,'producto_id'=>4],
            ['id'=>14,'material_id'=>11,'producto_id'=>4],
            ['id'=>15,'material_id'=>6,'producto_id'=>5],
            ['id'=>16,'material_id'=>7,'producto_id'=>5],
            ['id'=>17,'material_id'=>11,'producto_id'=>5],
            ['id'=>18,'material_id'=>7,'producto_id'=>6],
            ['id'=>19,'material_id'=>8,'producto_id'=>6],
            ['id'=>20,'material_id'=>11,'producto_id'=>6],
            ['id'=>21,'material_id'=>6,'producto_id'=>7],
            ['id'=>22,'material_id'=>6,'producto_id'=>7],

        ];

        foreach($materiales_productos as $material_producto){
            DB::table('material_producto')->insert([
                'id' => $material_producto['id'],
                'material_id' => $material_producto['material_id'],
                'producto_id' => $material_producto['producto_id'],
            ]);
        }

        $ventas = [
            ['id'=>1,'cliente_rut'=>'9.224.171-8','cantidad'=>2,'total'=>30000],
            ['id'=>2,'cliente_rut'=>'3.308.743-8','cantidad'=>2,'total'=>46000],
            ['id'=>3,'cliente_rut'=>'20.483.093-2','cantidad'=>1,'total'=>7000],
            ['id'=>4,'cliente_rut'=>'9.224.171-8','cantidad'=>1,'total'=>45990],
        ];

        foreach($ventas as $venta){
            DB::table('venta')->insert([
                'id' => $venta['id'],
                'fecha' => new DateTime('NOW'),
                'cliente_rut' => $venta['cliente_rut'],
                'cantidad' => $venta['cantidad'],
                'total' => $venta['total'],
            ]);
        }
        
        $ventas_productos = [
            ['id'=>1,'producto_id'=>1,'venta_id'=>1],
            ['id'=>2,'producto_id'=>2,'venta_id'=>2],
            ['id'=>3,'producto_id'=>6,'venta_id'=>2],
            ['id'=>4,'producto_id'=>5,'venta_id'=>3],
            ['id'=>5,'producto_id'=>3,'venta_id'=>4],
            ['id'=>6,'producto_id'=>5,'venta_id'=>4],
            ['id'=>7,'producto_id'=>6,'venta_id'=>4],
        ];
        
        foreach($ventas_productos as $venta_producto){
            DB::table('producto_venta')->insert([
                'id' => $venta_producto['id'],
                'producto_id' => $venta_producto['producto_id'],
                'venta_id' => $venta_producto['venta_id'],
            ]);
        }

    }
}
