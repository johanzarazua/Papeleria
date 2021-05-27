<?php

use Illuminate\Database\Seeder;

class StatuspagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('statuspago')->insert([
            'nombre' => 'Pendiente',
        ]);
        DB::table('statuspago')->insert([
            'nombre' => 'Pagado',
        ]);
        DB::table('statuspago')->insert([
            'nombre' => 'Pago contra entrega',
        ]);
    }
}
