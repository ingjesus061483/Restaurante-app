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
        Schema::table('mesas',function(Blueprint $table){
            $table->dropColumn('precio');
            $table->after('ocupado',function($table){
                $table->string('imagen')->default('mesa.png');
            });

        });
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mesas',function(Blueprint $table){
                $table->dropColumn('imagen');
                $table->decimal('precio',10,2);
        });
        //
    }
};
