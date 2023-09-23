<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this-> call([
            ConfiguracionSeeder::class,
            RoleSeeder::class,
            EstadoSeeder::class,
            TipoRegimenSeeder::class,
            EmpresaSeeder::class,
            UserSeeder::class,
            EmpleadoSeeder::class,
            ImpuestoSeeder::class,
            UnidadMedidaSeeder::class,
            TipoDocumentoSeeder::class,
            FormaPagoSeeder::class,
            ImpresoraSeeder::class,
        ]);
    }
}
