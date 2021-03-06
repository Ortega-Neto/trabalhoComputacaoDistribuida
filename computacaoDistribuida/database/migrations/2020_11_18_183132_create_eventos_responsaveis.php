<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosResponsaveis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 50);
            $table->string('data', 10);
            $table->integer('lote');
            $table->decimal('valor_lote', 10, 2, true);
            $table->integer('id_responsavel');
            $table->timestamps();
        });
        
        Schema::create('responsavels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_responsavel');
            $table->integer('id_evento')->nullable();
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
        Schema::dropIfExists('eventos');
        Schema::dropIfExists('resposaveis');
    }
}
