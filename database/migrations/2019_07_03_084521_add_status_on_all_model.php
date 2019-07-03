<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusOnAllModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('platforms', function (Blueprint $table) {
            $table->boolean('status');
        });

        Schema::table('webspaces', function (Blueprint $table) {
            $table->boolean('status');
        });

        Schema::table('designations', function (Blueprint $table) {
            $table->boolean('status');
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->boolean('status');
        });

        Schema::table('owners', function (Blueprint $table) {
            $table->boolean('status');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
