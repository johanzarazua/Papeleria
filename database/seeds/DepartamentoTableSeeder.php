<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('departamento')->insert([
            'nombre' => 'Papeleria',
        ]);
        DB::table('departamento')->insert([
            'nombre' => 'Servicios',
        ]);
    }
}
