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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('identificacion',50)->unique();
            $table->string('nombre',50);
            $table->string('apellido',50);
            $table->string('direccion',50);
            $table->string('telefono',50);
            //$table->string('email');
            $table->foreignId('user_id')            
            ->constrained('users')
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
        Schema::dropIfExists('clientes');
    }
};
