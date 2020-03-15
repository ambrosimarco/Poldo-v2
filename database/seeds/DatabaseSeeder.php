<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'name' => 'admin',
          'email' => 'admin@admin.com',
          'password' => Hash::make('admin'),
          'isAdmin' => 1
        ]);
      DB::table('users')->insert([
          'name' => 'user',
          'email' => 'user@user.com',
          'password' => Hash::make('user'),
          'isAdmin' => 0
        ]);
      DB::table('users')->insert([
        'name' => '5ai',
        'email' => '5ai@5ai.com',
        'password' => Hash::make('5ai'),
        'isAdmin' => 0
      ]);
    }
}
