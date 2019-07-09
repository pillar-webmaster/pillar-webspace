<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameWebspaceOwnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (Schema::hasTable('webspace_owners')){
            Schema::table('webspace_owners', function (Blueprint $table) {
                $table->dropForeign(['webspace_id']);
                $table->dropForeign(['owner_id']);
             });

            Schema::rename('webspace_owners', 'webspace_owner');

            Schema::table('webspace_owner', function (Blueprint $table) {
                $table->foreign('webspace_id')->references('id')->on('webspaces');
                $table->foreign('owner_id')->references('id')->on('owners');
            });
        }

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
