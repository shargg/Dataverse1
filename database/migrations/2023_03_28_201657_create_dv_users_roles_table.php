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
        Schema::create('dv_users_roles', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->dateTime('date_created')->useCurrent();
            $table->dateTime('last_changed')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dv_users_roles');
    }
};
