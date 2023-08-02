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
        Schema::create('orden_encabezados', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',50)->unique();            
            $table->date('fecha');
            $table->time('hora');
            $table->time('hora_entrega');
            $table->text('observaciones')->nullable();
            $table->decimal('total',10);

            $table->foreignId('cabaña_id')
            ->nullable()
            ->constrained('cabañas')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('cliente_id')
            ->nullable()
            ->constrained('clientes')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('empleado_id')            
            ->constrained('empleados')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('estado_id')->default(1)            
            ->constrained('estados')
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
        Schema::dropIfExists('orden_encabezados');
    }
};
