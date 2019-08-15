<?php

use Illuminate\Database\Seeder;

class WebspaceWithHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('webspaces')->insert([
            'name' => 'ESD',
            'url' => 'https://esd.sutd.edu.sg/',
            'mode' => 0,
            'description' => 'Engineering Systems and Design website',
            'platform_id' => 1,
            'status' => 1,
            'service' => 4,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('model_has_histories')->insert([
            'model_type' => 'App\Webspace',
            'model_id' => 1,
            'description' => 'Initiated',
        ]);
    }
}
