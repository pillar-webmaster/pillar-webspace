<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWebspaceAccess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('webspace_accesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            // additional
            $table->bigInteger('webspace_id')->unsigned();
            $table->bigInteger('access_id')->unsigned();
            $table->foreign('webspace_id')->references('id')->on('webspaces');
            $table->foreign('access_id')->references('id')->on('accesses');

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
