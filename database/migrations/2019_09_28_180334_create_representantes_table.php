<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('empresa_id')->unsigned()->nullable();
            $table->string('nome',250);
            $table->text('descricao');
            $table->string('CPF',14)->unique();
            $table->string('email',250)->unique();
            $table->string('password',250)->unique();
            $table->string('tipoProduto');
            $table->bigInteger('localizacao')->unique()->nullable();
            $table->string('imagem',250)->nullable();
            $table->string('typeUser',250);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('representantes', function (Blueprint $table){
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('representantes');
    }
}
