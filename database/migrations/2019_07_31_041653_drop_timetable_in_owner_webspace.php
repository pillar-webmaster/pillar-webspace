<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTimetableInOwnerWebspace extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('owner_webspace','created_at')){
            Schema::table('owner_webspace', function (Blueprint $table) {
                $table->dropColumn('created_at');
            });
        }

        if (Schema::hasColumn('owner_webspace','updated_at')){
            Schema::table('owner_webspace', function (Blueprint $table) {
                $table->dropColumn('updated_at');
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
        Schema::table('owner_webspace', function (Blueprint $table) {
            //
        });
    }
}
