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
        DB::table('departments')->insert([
            'name' => 'Engineering Systems and Design',
            'status' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'Aaron Angelo Vicuna',
            'email' => 'arjieangelsences@gmail.com',
            'password' => bcrypt('logan9c20'),
        ]);
    }
}
