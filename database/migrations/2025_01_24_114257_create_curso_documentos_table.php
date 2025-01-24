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
        Schema::create('curso_documentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estado_id')->constrained();
            $table->foreignId('curso_id')->constrained();
            $table->foreignId('ciclo_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('descripcion', 250);
            $table->tinyInteger('completo')->default(0);
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
        Schema::dropIfExists('curso_documentos');
    }
};
