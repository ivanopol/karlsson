<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'ivanopol',
            'email' => 'ivanopol777@mail.ru',
            'password' => bcrypt('1234567890'),
        ]);
    }
}
