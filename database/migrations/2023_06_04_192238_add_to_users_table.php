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
            $table->after('role_id',function($table){
              

                $table->foreignId('empresa_id')
                      ->nullable()
                      ->constrained('empresas')
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
            $table->dropForeign('users_empresa_id_foreign');
            $table->dropColumn('empresa_id');
            //
        });
    }
};
