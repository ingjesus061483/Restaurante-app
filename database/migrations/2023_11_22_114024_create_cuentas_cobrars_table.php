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
        Schema::create('cuentas_cobrars', function (Blueprint $table) {
            $table->id();
            $table ->date("fecha");
            $table->integer("tiempo");
            $table->decimal("monto" ,10,2);
            $table->decimal("interes",10,2);
            $table->foreignId('orden_id')
                  ->constrained('orden_encabezados')
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
        Schema::dropIfExists('cuentas_cobrars');
    }
};
