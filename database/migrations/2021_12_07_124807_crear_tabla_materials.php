<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaMaterials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string("nombre",50);
            $table->string("descripcion",100);
            $table->string("rut_proveedor",12);
            $table->string("unidad_medida",10);
            $table->integer("stock")->unsigned();
            $table->integer("stock_minimo")->unsigned();
            $table->integer("stock_maximo")->unsigned();
            $table->integer("precio")->unsigned();
            $table->timestamp("fecha");
            $table->foreign("rut_proveedor")->references("rut")->on("proveedores");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
}
