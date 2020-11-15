<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComerciantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comerciantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('razaoSocial',250)->unique();
            $table->string('CNPJ',18)->unique();
            $table->string('email',250)->unique()->nullable();
            $table->string('password',250)->unique();
            $table->string('endereco',250);
            $table->string('imagem',250)->nullable();
            $table->string('typeUser',250);
            $table->rememberToken();
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
        Schema::dropIfExists('comerciantes');
    }
}
