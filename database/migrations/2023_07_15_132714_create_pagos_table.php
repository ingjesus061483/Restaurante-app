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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',)->unique();
            $table->dateTime('fecha_hora');
            $table->decimal('subtotal',10,2);
            $table->decimal('impuesto',10,2);
            $table->decimal('descuento',10,2);
            $table->decimal('total_pagar',10,2);
            $table->decimal('recibido',10,2);
            $table->decimal('cambio',10,2);
            $table->string('observaciones',255)->nullable();

            $table->foreignId('orden_id')            
            ->constrained('orden_encabezados')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('forma_pago_id')            
            ->constrained('forma_pagos')
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
        Schema::dropIfExists('pagos');
    }
};
