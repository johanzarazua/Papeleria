<?php

use Illuminate\Database\Seeder;

class StatuspedidoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('statuspedido')->insert([
            'nombre' => 'Confirmado',
        ]);
        DB::table('statuspedido')->insert([
            'nombre' => 'En camino',
        ]);
        DB::table('statuspedido')->insert([
            'nombre' => 'Entregado',
        ]);
    }
}
