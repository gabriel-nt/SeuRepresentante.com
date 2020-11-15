<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->bigInteger('representante_id')->unsigned();
            $table->bigInteger('comerciante_id')->unsigned();
            // $table->bigInteger('conversa_id')->unsigned();
            // $table->bigInteger('produto_id')->unsigned();
            $table->string('valorTotal');
            $table->string('subTotal');
            $table->timestamps();
        });

        Schema::table('pedidos', function (Blueprint $table){
            $table->foreign('representante_id')->references('id')->on('representantes');
            $table->foreign('comerciante_id')->references('id')->on('comerciantes');
            // $table->foreign('conversa_id')->references('id')->on('conversas');
            // $table->foreign('produto_id')->references('id')->on('produtos');
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
