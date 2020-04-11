<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SystemSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->unsignedbigInteger('id');
            $table->boolean('online')->default('1')->nullable(false);
            $table->boolean('debug_mode')->default('0')->nullable(false);
            $table->string('offline_message', 250)->default('Sistema offline.')->nullable(false);
            $table->time('order_time_limit', 0)->default('08:30')->nullable(false);
            $table->time('retire_time', 0)->default('09:30')->nullable(false);
            $table->integer('session_timeout')->default('60')->nullable(false)->comment = 'Measured in seconds';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_settings');
    }
}
