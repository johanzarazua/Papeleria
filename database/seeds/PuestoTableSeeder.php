<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PuestoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('puestos')->insert([
            'nombre' => 'Administrador',
        ]);
        DB::table('puestos')->insert([
            'nombre' => 'Vendedor',
        ]);
        DB::table('puestos')->insert([
            'nombre' => 'Repartidor',
        ]);
    }
}
