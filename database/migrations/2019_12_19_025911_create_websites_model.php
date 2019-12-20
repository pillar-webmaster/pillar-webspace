<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsitesModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url');
            $table->bigInteger('platform_id')->unsigned();
            $table->bigInteger('webspace_id')->unsigned();
            $table->boolean('status');
            $table->foreign('platform_id')->references('id')->on('platforms');
            $table->foreign('webspace_id')->references('id')->on('webspaces');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('websites_model');
    }
}
