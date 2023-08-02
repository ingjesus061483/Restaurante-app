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
        Schema::create('factura_encabezados', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string ('codigo',50)->unique();                       
            $table->decimal('subtotal',10);
            $table->decimal('impuestos',10);          
            $table->decimal('descuento',10);
            $table->decimal('recibido',10);
           
            $table->foreignId('empleado_id')
            ->constrained('empleados')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->foreignId('cliente_id')
            ->nullable()
            ->constrained('clientes')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            
            $table->foreignId('tipo_documento_id')
            ->constrained('tipo_documentos')
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
        Schema::dropIfExists('factura_encabezados');
    }
};
