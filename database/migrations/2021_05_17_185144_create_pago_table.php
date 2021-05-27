<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pedidos_id');
            $table->double('monto',10,2);
            $table->string('tipo_pago');
            $table->string('id_PayPal')->nullable();
            $table->string('status_PayPal')->nullable();
            $table->string('payerId_PayPal')->nullable();
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
        Schema::dropIfExists('pago');
    }
}
