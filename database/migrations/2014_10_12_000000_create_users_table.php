<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 20)->unique();
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->enum('role', ['class', 'admin', 'observer'])->default('class');	
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        App\User::create([
        'name'   => 'admin',
        'email'   => 'admin@admin',
        'password'   => Hash::make('admin'),
        'isAdmin'   => '1',
    ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
