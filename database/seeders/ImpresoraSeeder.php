<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ImpresoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        DB::table('impresoras')->insert([            
            [                
                'codigo'=>'001',
                'nombre'=>'Impresora1',
                'recurso_compartido'=>'pos',           
                'tamaño_fuente_encabezado'=>2,
                'tamaño_fuente_contenido'=>1           
            ],        
        ]);
                //
    }
}
