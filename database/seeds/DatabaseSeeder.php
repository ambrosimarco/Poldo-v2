<?php

use Illuminate\Database\Seeder;
use App\Sandwich;
use App\Ingredient;
use Carbon\Carbon;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

      //Delete all the records in the tables

      DB::statement('DELETE FROM users');
      DB::statement('DELETE FROM pairings');
      DB::statement('DELETE FROM ingredients');
      DB::statement('DELETE FROM sandwiches');

      //Accounts

      DB::table('users')->insert([
        'name' => 'admin',
        'email' => 'admin@admin.com',
        'password' => Hash::make('admin'),
        'isAdmin' => 1,
        'canOrder' => 0
        ]);
      DB::table('users')->insert([
        'name' => 'user',
        'email' => 'user@user.com',
        'password' => Hash::make('user'),
        'isAdmin' => 0,
        'canOrder' => 1
        ]);
      DB::table('users')->insert([
        'name' => '5ai',
        'email' => '5ai@5ai.com',
        'password' => Hash::make('5ai'),
        'isAdmin' => 0,
        'canOrder' => 1
        ]);

      //Sandwiches

      DB::table('sandwiches')->insert([
        'name' => 'Piadina al cotto',
        'price' => '2.00',
        'description' => 'Piadina al cotto',
        'created_at' => Carbon::now()
      ]);
      DB::table('sandwiches')->insert([
        'name' => 'Maxi pizza',
        'price' => '2.00',
        'description' => 'Scelta casualmente tra Margherita, Prosciutto, Funghi, Würstel, Salamino',
      ]);
      DB::table('sandwiches')->insert([
        'name' => 'Focaccia',
        'price' => '1.30',
        'description' => 'Focaccia',
      ]);

      //Ingredients

      DB::table('ingredients')->insert([
        'name' => 'Prosciutto cotto',
      ]);

      DB::table('ingredients')->insert([
        'name' => 'Prosciutto crudo',
      ]);

      DB::table('ingredients')->insert([
        'name' => 'Salsa ai funghi',
      ]);

      DB::table('ingredients')->insert([
        'name' => 'Salamino',
      ]);

      DB::table('ingredients')->insert([
        'name' => 'Pomodoro',
      ]);
      
      DB::table('ingredients')->insert([
        'name' => 'Mozzarella',
      ]);

      DB::table('ingredients')->insert([
        'name' => 'Funghi',
      ]);
      
      DB::table('ingredients')->insert([
        'name' => 'Würstel',
      ]);

      //Recipes

      $piadina_cotto = Sandwich::where('name', 'Piadina al cotto')->get()->first();
      $prosciutto_cotto = Ingredient::where('name', 'Prosciutto cotto')->get()->first();

      DB::table('pairings')->insert([
        'sandwich_id' => $piadina_cotto->id,
        'ingredient_id' => $prosciutto_cotto->id,
      ]);

      $maxi_pizza = Sandwich::where('name', 'Maxi pizza')->get()->first();
      $mozzarella = Ingredient::where('name', 'Mozzarella')->get()->first();
      $pomodoro = Ingredient::where('name', 'Pomodoro')->get()->first();

      DB::table('pairings')->insert([
        'sandwich_id' => $maxi_pizza->id,
        'ingredient_id' => $mozzarella->id,
      ]);
      DB::table('pairings')->insert([
        'sandwich_id' => $maxi_pizza->id,
        'ingredient_id' => $pomodoro->id,
      ]);

      $focaccia = Sandwich::where('name', 'Focaccia')->get()->first();

      DB::table('pairings')->insert([
        'sandwich_id' => $focaccia->id,
        'ingredient_id' => $prosciutto_cotto->id,
      ]);
    }
}
