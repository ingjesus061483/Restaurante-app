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
        Schema::table('cuentas_cobrars', function (Blueprint $table) {
            $table->after('orden_id',function($table){
                $table->foreignId('tipo_cobro_id')               
                      ->constrained('tipo_cobros')
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
        Schema::table('cuentas_cobrars', function (Blueprint $table) {            
            $table->dropForeign('cuentas_cobrars_tipo_cobro_id_foreign');            
            $table->dropColumn('tipo_cobro_id');                    //                   
        });
    
        
  
    }
};
