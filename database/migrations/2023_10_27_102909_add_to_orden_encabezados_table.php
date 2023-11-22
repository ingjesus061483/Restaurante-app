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
        Schema::table('orden_encabezados', function (Blueprint $table) {
            $table->after('estado_id',function($table){
                $table->tinyInteger('credito')->default(0);
            });
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orden_encabezados', function (Blueprint $table) {
            $table->dropColumn('credito');
            //
        });
    }
};
