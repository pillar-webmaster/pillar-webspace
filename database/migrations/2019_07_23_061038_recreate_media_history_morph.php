<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecreateMediaHistoryMorph extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('medias')){
            Schema::table('model_has_histories', function (Blueprint $table) {
                $table->dropForeign(['media_id']);
            });
        }

        Schema::dropIfExists('medias');
        Schema::dropIfExists('model_has_histories');

        Schema::create('medias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('path');
            $table->longText('description');
            $table->boolean('status');
            $table->bigInteger('webspace_id')->unsigned();
            $table->timestamps();
            $table->foreign('webspace_id')->references('id')->on('webspaces')->onDelete('cascade');
        });

        Schema::create('model_has_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            // morphs will create model_id and model_type
            $table->morphs('model');
            $table->longText('description');
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
