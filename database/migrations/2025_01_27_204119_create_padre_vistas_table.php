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
        Schema::create('padre_vistas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estado_id')->constrained();
            $table->foreignId('padre_id')->constrained();
            $table->foreignId('alumno_id')->constrained();
            $table->foreignId('curso_documento_id')->constrained();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('padre_vistas');
    }
};
