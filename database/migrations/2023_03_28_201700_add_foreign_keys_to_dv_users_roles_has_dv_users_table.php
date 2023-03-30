<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dv_users_roles_has_dv_users', function (Blueprint $table) {
            $table->foreign(['dv_users_roles_id'], 'fk_dv_users_roles_has_dv_users_dv_users_roles1')->references(['id'])->on('dv_users_roles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['dv_users_id'], 'fk_dv_users_roles_has_dv_users_dv_users1')->references(['id'])->on('dv_users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dv_users_roles_has_dv_users', function (Blueprint $table) {
            $table->dropForeign('fk_dv_users_roles_has_dv_users_dv_users_roles1');
            $table->dropForeign('fk_dv_users_roles_has_dv_users_dv_users1');
        });
    }
};
