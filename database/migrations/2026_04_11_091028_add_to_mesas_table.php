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
        Schema::table('mesas', function (Blueprint $table) {
             $table->after('imagen',function($table){
                $table->foreignId('dependencia_id')->constrained('dependencias')->onupdate('cascade')->
                onDelete('cascade');
            });
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mesas', function (Blueprint $table) {
                $table->dropForeign(['dependencia_id']);
                $table->dropColumn('dependencia_id');
            //
        });
    }
};
