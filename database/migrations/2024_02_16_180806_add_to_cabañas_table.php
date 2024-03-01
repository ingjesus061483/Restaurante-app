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
        Schema::table('cabañas',function(Blueprint $table){
            $table->dropColumn('precio');
            $table->string('imagen')->nullable();

        });
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cabañas',function(Blueprint $table){
                $table->dropColumn('imagen');                    
                $table->decimal('precio',10,2);
        });
        //
    }
};
