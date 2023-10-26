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
        Schema::create('caja_movimientos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora');
            $table->string('concepto',50);
            $table->decimal('valor');
            $table->tinyInteger('ingreso')
                  ->default(1);
            $table->foreignId('caja_id')
                  ->constrained('cajas')
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
        Schema::dropIfExists('caja_movimientos');
    }
};
