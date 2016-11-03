<?php

use Illuminate\Database\Seeder;

class admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => str_random(10),
            'lastname' => str_random(20),
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'user_type' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => str_random(10),
            'lastname' => str_random(20),
            'email' => 'teacher@teacher.com',
            'password' => bcrypt('password'),
            'user_type' => 'teacher',
        ]);
    }
}
