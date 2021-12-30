<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaMaterialProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_producto', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("material_id")->unsigned();
            $table->bigInteger("producto_id")->unsigned();
            $table->foreign("material_id")->references("id")->on("materials");
            $table->foreign("producto_id")->references("id")->on("productos");
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
        Schema::dropIfExists('material_producto');
    }
}
