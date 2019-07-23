<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaAndHistoryMorph extends Migration
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
            $table->timestamps();
        });

        Schema::create('model_has_histories', function (Blueprint $table) {
            $table->bigInteger('media_id')->unsigned();
            // morphs will create table_name_id and table_name_type
            $table->morphs('model');
            $table->foreign('media_id')->references('id')->on('medias')->onDelete('cascade');
            $table->primary([
                'media_id', 'model_id', 'model_type'
            ], 
            'model_has_histories__media_model_type_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medias');
        Schema::dropIfExists('model_has_histories');
    }
}
