<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RedoMediaHistoryMorph extends Migration
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
