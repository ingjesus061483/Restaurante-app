<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DependenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dependencias')->insert([
            ['codigo'=>'DEP-001','nombre'=>'Dependencia 1','descripcion'=>'Descripción de la dependencia 1'],
            ['codigo'=>'DEP-002','nombre'=>'Dependencia 2','descripcion'=>'Descripción de la dependencia 2'],
            ['codigo'=>'DEP-003','nombre'=>'Dependencia 3','descripcion'=>'Descripción de la dependencia 3'],
        ]);
        //
    }
}
