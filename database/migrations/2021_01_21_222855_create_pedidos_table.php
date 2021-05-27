<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('correo');
            $table->string('telefono');
            $table->string('calle');
            $table->string('colonia');
            $table->string('municipio');
            $table->string('estado');
            $table->string('cp');
            $table->date('fecha_entrega');
            $table->unsignedInteger('horariosentrega_id');
            $table->string('comentarios', 500);
            $table->integer('statuspedido_id')->default(1);
            $table->integer('statuspago_id')->default(1);
            $table->integer('status_notificacion')->default(0);
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
        Schema::dropIfExists('pedidos');
    }
}
