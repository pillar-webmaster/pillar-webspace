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
        $user = DB::table('users')->insert([
            'name' => 'Aaron Angelo Vicuna',
            'email' => 'arjieangelsences@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('logan9c20'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('mode_has_roles')->insert([
            'role_id' => 4,
            'model_type' => 'App\User',
            'model_id' => $user->id
        ]);
    }
}
