<?php

use Illuminate\Database\Seeder;

class HorarioentregaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('horariosentrega')->insert([
            'hora_in' => 10,
            'hora_fn' => 11
        ]);
        DB::table('horariosentrega')->insert([
            'hora_in' => 11,
            'hora_fn' => 12
        ]);
        DB::table('horariosentrega')->insert([
            'hora_in' => 12,
            'hora_fn' => 13
        ]);
        DB::table('horariosentrega')->insert([
            'hora_in' => 13,
            'hora_fn' => 14
        ]);
        DB::table('horariosentrega')->insert([
            'hora_in' => 14,
            'hora_fn' => 15
        ]);
        DB::table('horariosentrega')->insert([
            'hora_in' => 15,
            'hora_fn' => 16
        ]);
        DB::table('horariosentrega')->insert([
            'hora_in' => 16,
            'hora_fn' => 17
        ]);
        DB::table('horariosentrega')->insert([
            'hora_in' => 17,
            'hora_fn' => 18
        ]);
    }
}
