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
        Schema::create('dv_users_roles_has_dv_users', function (Blueprint $table) {
            $table->integer('dv_users_roles_id')->index('fk_dv_users_roles_has_dv_users_dv_users_roles1_idx');
            $table->integer('dv_users_id')->index('fk_dv_users_roles_has_dv_users_dv_users1_idx');

            $table->primary(['dv_users_roles_id', 'dv_users_id'], 'pk_dv_users_roles_has_dv_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dv_users_roles_has_dv_users');
    }
};
