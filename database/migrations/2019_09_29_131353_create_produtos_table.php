<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('representante_id')->unsigned()->nullable();
            $table->string('nome');
            $table->text('descricao');
            $table->string('marca');
            $table->string('valor');
            $table->double('price');
            $table->string('unidadeVenda');
            $table->integer('estoque');
            $table->string('imagem',250);
            $table->timestamps();
        });

        Schema::table('produtos', function (Blueprint $table){
            $table->foreign('representante_id')->references('id')->on('representantes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
