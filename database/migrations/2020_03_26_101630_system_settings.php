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
            $table->decimal('order_time_limit', 4, 2)->default('08.30')->nullable(false);
            $table->decimal('retire_time', 4, 2)->default('09.30')->nullable(false);
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
