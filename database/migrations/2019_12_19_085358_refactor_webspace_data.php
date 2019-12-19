<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactorWebspaceData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        // run the refactoring first
        Artisan::call('db:refactor', [
            '--class' => 'WebspaceTableRefactor',
        ]);
        // drop columns in webspace
        Schema::table('webspaces', function (Blueprint $table) {
            $table->dropForeign('webspaces_platform_id_foreign');
            $table->dropColumn('platform_id');
            $table->dropColumn('url');
            $table->dropColumn('mode');
            $table->dropColumn('description');
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
