<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string("nombre",50);
            $table->bigInteger("categoria_id")->unsigned();
            $table->integer("cantidad_material")->unsigned();
            $table->string("descripcion",300);
            $table->integer("cantidad")->unsigned();
            $table->integer("precio")->unsigned();
            $table->timestamp('fecha');
            $table->timestamps();
            $table->foreign("categoria_id")->references("id")->on("categorias");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
