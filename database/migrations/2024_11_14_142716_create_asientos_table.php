<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asientos', function (Blueprint $table) {
            $table->id(); // primary key
            $table->integer('fila');
            $table->integer('columna');
            $table->boolean('reservado')->default(false); // true reservado, false libre
            $table->unsignedBigInteger('idSala');
            $table->foreign('idSala')->references('id')->on('salas');
            $table->timestamps();

        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asientos');
    }
};