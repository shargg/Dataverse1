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
        Schema::table('dv_users', function (Blueprint $table) {
            $table->foreign(['wp_users_ID'], 'fk_dv_users_wp_users1')->references(['ID'])->on('wp_users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dv_users', function (Blueprint $table) {
            $table->dropForeign('fk_dv_users_wp_users1');
        });
    }
};
