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
        Schema::create('cuentas_cobrar_detalles', function (Blueprint $table) {
            $table->id();
            $table->date("fecha");
            $table->decimal("valor",10,2);
            $table->foreignId('cuenta_cobrar_id')
            ->constrained('cuentas_cobrars')
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
        Schema::dropIfExists('cuentas_cobrar_detalles');
    }
};
