<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecreateModelHasDescriptionStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        // drop the table first, missed to remember that all table should be plural
        Schema::dropIfExists('model_has_description_status');
        // recreate with plural
        Schema::create('model_has_description_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            // morphs will create model_id and model_type
            $table->morphs('model');
            $table->longText('description');
            $table->string('mode');
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
