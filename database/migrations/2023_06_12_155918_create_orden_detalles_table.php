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
        Schema::create('orden_detalles', function (Blueprint $table) {
            $table->id();
            $table->decimal('cantidad',10);
            $table->decimal('valor_unitario',10);
            $table->decimal('total',10);
            
            $table->foreignId('orden_encabezado_id')            
            ->constrained('orden_encabezados')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('producto_id')            
            ->constrained('productos')
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
        Schema::dropIfExists('orden_detalles');
    }
};
