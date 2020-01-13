<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessWebspace extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_webspace', function (Blueprint $table) {
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
        Schema::dropIfExists('access_webspace');
    }
}
