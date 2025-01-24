<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estado_id')->constrained();
            $table->foreignId('pais_id')->constrained();
            $table->string('documento')->default('0');
            $table->string('nombre');
            $table->string('apellido');
            $table->tinyInteger('sexo')->default(0);
            $table->string('email', 250)->nullable();
            $table->string('celular', 12)->nullable();
            $table->string('direccion', 250);
            $table->string('foto', 250)->nullable();
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
        Schema::dropIfExists('personas');
    }
};
