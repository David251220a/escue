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
        Schema::create('padre_alumnos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('padre_id')->constrained();
            $table->foreignId('alumno_id')->constrained();
            $table->foreignId('estado_id')->constrained();
            $table->boolean('verificado')->default(false);
            $table->string('documento_frente', 250);
            $table->string('documento_reverso', 250);
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
        Schema::dropIfExists('padre_alumnos');
    }
};
