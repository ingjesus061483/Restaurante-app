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
        Schema::create('pago_detalles', function (Blueprint $table) {
            $table->id();
            $table->string('detalle_pago',50);
            $table->decimal('valor_recibido',10,2);
            $table->foreignId('forma_pago_id')            
            ->constrained('forma_pagos')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('pago_id')            
            ->constrained('pagos')
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
        Schema::dropIfExists('pago_detalles');
    }
};
