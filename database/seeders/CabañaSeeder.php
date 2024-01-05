<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CabañaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0;$i<=19;$i++)
        {
            $arr[$i]=[
                'nombre'=>'mesa'.$i+1,'codigo'=>'0'.$i+1,'precio'=>0,'capacidad_maxima'=>4,
                ];

        }
        DB::table('cabañas')->insert($arr);
        
        //
    }
}
