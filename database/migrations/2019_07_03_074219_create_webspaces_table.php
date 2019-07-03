<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebspacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webspaces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            // additional
            $table->string('name');
            $table->string('url');
            $table->string('mode');
            $table->longText('description');
            $table->bigInteger('platform_id')->unsigned();
            $table->foreign('platform_id')->references('id')->on('platforms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webspaces');
    }
}
