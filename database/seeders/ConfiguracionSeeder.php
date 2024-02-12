<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('configuracions')->insert([
            ['nombre'=>'ImpoConsumo','valor'=>'0.08'],
            ['nombre'=>'propina','valor'=>'0'], 
            ['nombre'=>'descuento','valor'=>''],                      
            ['nombre'=>'Valor_Domicilio','valor'=>'0'],                     
        ]);
        //
    }
}
