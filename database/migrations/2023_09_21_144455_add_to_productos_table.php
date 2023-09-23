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
        Schema::table('productos', function (Blueprint $table) {
            $table->after('tiempo_coccion',function($table){
                $table->foreignId('impresora_id')
                     
                      ->constrained('impresoras')
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
        Schema::table('productos', function (Blueprint $table) {
            $table->dropForeign('productos_impresora_id_foreign');
            $table->dropColumn('impresora_id');
             //   //
        });
    }
};
