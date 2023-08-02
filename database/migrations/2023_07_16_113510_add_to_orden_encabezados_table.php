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
                $table->foreignId('tipo_documento_id')
                ->constrained('tipo_documentos')
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
        Schema::table('orden_encabezados', function (Blueprint $table) {
            $table->dropForeign('orden_encabezados_tipo_documento_id_foreign');
            $table->dropColumn('tipo_documento_id');
             //
        });
    }
};
