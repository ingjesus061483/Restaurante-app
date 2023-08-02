<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('empleados')->insert([
            'identificacion'=>'111',
            'nombre'=>'administrador',
            'apellido'=>'administrador',
            'direccion'=>'555',
            'telefono'=>'33333',
            'user_id'=>1
        ]);
            //
    }
}
