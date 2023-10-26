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
        Schema::table('users', function (Blueprint $table) {
            $table->after('password',function($table){
                $table->foreignId('caja_id')
                      ->nullable()
                      ->constrained('cajas')
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_caja_id_foreign');
            $table->dropColumn('caja_id');

            //
        });
    }
};
