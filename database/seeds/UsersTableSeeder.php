<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Aaron Angelo Vicuna',
            'email' => 'arjieangelsences@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('logan9c20'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
