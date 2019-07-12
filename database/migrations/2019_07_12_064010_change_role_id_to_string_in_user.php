<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeRoleIdToStringInUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('users','role_id')){
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign('users_role_id_foreign');
                $table->dropColumn('role_id');
                $table->string('roles');
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
        Schema::table('string_in_user', function (Blueprint $table) {
            //
        });
    }
}
