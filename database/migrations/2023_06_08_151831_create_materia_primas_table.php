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
        Schema::create('materia_primas', function (Blueprint $table) {
            $table->id();
            $table->string ('codigo',100)->unique();
            $table->string('nombre',255);            
            $table->text('descripcion')->nullable();
            $table->decimal('costo_unitario',10);            
            $table->string('imagen',100)->nullable();            
            $table->foreignId('unidad_medida_id')
            ->constrained('unidad_medidas')
            ->onUpdate('cascade')
            ->onDelete('cascade');
 
            $table->foreignId('categoria_id')
            ->constrained('categorias')
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
        Schema::dropIfExists('materia_primas');
    }
};
