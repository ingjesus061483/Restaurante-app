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
        Schema::table('orden_detalles', function (Blueprint $table) {
            $table->after('total',function($table){
                $table-> tinyInteger('impreso')->default(0);
                $table-> tinyInteger('venta_costo')->default(0);
            });
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orden_detalles', function (Blueprint $table) {
            $table-> dropColumn('impreso');
            $table-> dropColumn('venta_costo');
            //
        });
    }
};
