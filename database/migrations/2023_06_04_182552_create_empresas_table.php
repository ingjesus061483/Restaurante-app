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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nit')->unique();
            $table->string('nombre');
            $table->string('camara_de_comercio')->nullable();            
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email');
            $table->string('contacto');
            $table->string('logo')->nullable();
            $table->text('slogan')->nullable();
            $table->foreignId('tipo_regimen_id')            
            ->constrained('tipo_regimens')
            ->onUpdate('cascade')
            ->onDelete('cascade');         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
