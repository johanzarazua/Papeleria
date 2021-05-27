<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->double('p_costo', 8,2)->nullable();
            $table->double('p_venta', 8,2)->nullable();
            $table->double('p_mayoreo', 8,2)->nullable();
            $table->unsignedInteger('inventario')->nullable();
            $table->unsignedInteger('inventario_min')->nullable();
            //$table->unsignedInteger('categoria_id');
            $table->unsignedInteger('colores')->nullable()->default(0);
            $table->unsignedInteger('departamento_id');
            $table->string('imagen')->nullable()->default(null);
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
        Schema::dropIfExists('inventario');
    }
}
