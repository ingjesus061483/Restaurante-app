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
        Schema::table('existencias', function (Blueprint $table) {
            $table->after('entrada',function($table){
                $table->foreignId('materia_prima_id')->nullable()
                      ->constrained('materia_primas')
                      ->onUpdate('cascade')
                      ->onDelete('cascade');
            });
            $table->after('entrada',function($table){
                $table->foreignId('producto_id')->nullable()
                      ->constrained('productos')
                      ->onUpdate('cascade')
                      ->onDelete('cascade');
            });
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('existencias', function (Blueprint $table) {
            //
            $table->dropForeign('existencias_materia_prima_id_foreign');
            $table->dropForeign('existencias_producto_id_foreign');
            $table->dropColumn('materia_prima_id');
            $table->dropColumn('producto_id');

        });
    }
};
