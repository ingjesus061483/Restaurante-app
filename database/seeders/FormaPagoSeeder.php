<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormaPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('forma_pagos')->insert([
            ['nombre'=>'Contado'],         
            ['nombre'=>'Datafono'],    
            ['nombre'=>'Transferencia'],    
        ]);
        //
    }
}
