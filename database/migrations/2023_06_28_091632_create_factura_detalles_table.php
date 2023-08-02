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
        Schema::create('factura_detalles', function (Blueprint $table) {
            $table->id();
            $table ->integer('cantidad');
            $table->decimal('valor_unitario',10);
            $table->decimal('total',10);
            
            $table->foreignId('producto_id')
            ->nullable()
            ->constrained('productos')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('cabaña_id')
            ->nullable()
            ->constrained('cabañas')
            ->onUpdate('cascade')
            ->onDelete('cascade');
 
            $table->foreignId('factura_id')
            ->constrained('factura_encabezados')
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
        Schema::dropIfExists('factura_detalles');
    }
};
