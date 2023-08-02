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
            ['nombre'=>'hipoConsumo','valor'=>'0.08'],
            ['nombre'=>'propina','valor'=>''], 
            ['nombre'=>'descuento','valor'=>''],            
            ['nombre'=>'impresora_pos','valor'=>''],                     
        ]);
        //
    }
}
