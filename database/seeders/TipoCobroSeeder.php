<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoCobroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_cobros')->insert(
            [
                ["nombre"=>"Mensual"],
                ["nombre"=>"Quincenal"],
                ["nombre"=>"Diario"],
            ]);
        //
    }
}
