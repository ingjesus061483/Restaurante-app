<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('empresas')->insert([
            'nit'=>'11111-1',
            'nombre'=>'empresa ficticia',
            'camara_de_comercio'=>'0001',
            'direccion'=>'b/quilla',
            'telefono'=>'5444555',
            'email'=>'alguien@ejempo.com',
            'contacto'=>'pepto perez'  ,            
            'tipo_regimen_id'=>1
        ]);
        //
    }
}
