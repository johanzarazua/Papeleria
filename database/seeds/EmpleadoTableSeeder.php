<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('empleado')->insert([
            'nombre' => 'Johan Zarazua',
            'puesto_id' => 1,
            'estado' => 'Activo',
        ]);
    }
}
