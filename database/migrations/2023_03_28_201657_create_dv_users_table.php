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
        Schema::create('dv_users', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name')->nullable();
            $table->string('username')->nullable()->unique('username_UNIQUE');
            $table->string('password')->nullable();
            $table->string('email')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->dateTime('date_created')->useCurrent();
            $table->dateTime('last_changed')->useCurrent();
            $table->unsignedBigInteger('wp_users_ID')->nullable()->index('fk_dv_users_wp_users1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dv_users');
    }
};
