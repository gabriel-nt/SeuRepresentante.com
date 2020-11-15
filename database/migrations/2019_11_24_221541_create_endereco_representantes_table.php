<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecoRepresentantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endereco_representantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('representante_id')->unsigned();
            $table->string('CEP', 9);
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->string('rua');
            $table->string('estado');
            $table->string('cidade');
            $table->string('ibge')->nullable();
            $table->timestamps();
        });

        Schema::table('endereco_representantes', function (Blueprint $table){
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
        Schema::dropIfExists('endereco_representante');
    }
}
