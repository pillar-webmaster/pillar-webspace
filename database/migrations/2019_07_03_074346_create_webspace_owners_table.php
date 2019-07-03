<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebspaceOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webspace_owners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            // additional
            $table->bigInteger('webspace_id')->unsigned();
            $table->bigInteger('owner_id')->unsigned();
            $table->foreign('webspace_id')->references('id')->on('webspaces');
            $table->foreign('owner_id')->references('id')->on('owners');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webspace_owners');
    }
}
