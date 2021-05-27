<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'empleado_id' => 1,
            'email' => 'johanzarazua0@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
