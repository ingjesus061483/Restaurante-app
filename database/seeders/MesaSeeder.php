<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0;$i<=19;$i++)
        {
            $arr[$i]=
            [
                'nombre'=>'Mesa '.$i+1,
                'codigo'=>'0'.$i+1,
                'imagen'=>'mesa.png',
                'capacidad_maxima'=>4,
            ];

        }
        DB::table('mesas')->insert($arr);

        //
    }
}
