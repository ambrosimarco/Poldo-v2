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
        'role' => 'admin',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'api_token' => Str::random(60),
        ]);
      DB::table('users')->insert([
        'name' => 'prof',
        'email' => 'prof@prof.com',
        'password' => Hash::make('prof'),
        'role' => 'admin',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'api_token' => Str::random(60),
        ]);
      DB::table('users')->insert([
        'name' => 'bar',
        'email' => 'bar@bar.com',
        'password' => Hash::make('bar'),
        'role' => 'bar',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'api_token' => Str::random(60),
        ]);
      DB::table('users')->insert([
        'name' => '5ai',
        'email' => '5ai@5ai.com',
        'password' => Hash::make('5ai'),
        'role' => 'class',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'api_token' => Str::random(60),
        ]);
      DB::table('users')->insert([
        'name' => '5bi',
        'email' => '5bi@5bi.com',
        'password' => Hash::make('5bi'),
        'role' => 'class',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'api_token' => Str::random(60),
        ]);

      //Sandwiches

      DB::table('sandwiches')->insert([
        'name' => 'Piadina al cotto',
        'price' => '2.00',
        'description' => 'Piadina al prosciutto cotto',
        'type' => 'Caldo',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      DB::table('sandwiches')->insert([
        'name' => 'Maxi pizza',
        'price' => '2.00',
        'description' => 'Scelta casualmente tra Margherita, Prosciutto, Funghi, Würstel, Salamino',
        'type' => 'Caldo',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      DB::table('sandwiches')->insert([
        'name' => 'Focaccia',
        'price' => '1.30',
        'description' => 'Focaccia al prosciutto cotto',
        'type' => 'Freddo',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      DB::table('sandwiches')->insert([
        'name' => 'Salsa ai funghi',
        'price' => '1.40',
        'description' => 'Panino con salsa ai funghi',
        'type' => 'Freddo',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      DB::table('sandwiches')->insert([
        'name' => 'Tramezzino (salsa ai funghi)',
        'price' => '0.70',
        'description' => 'Tramezzino con salsa ai funghi',
        'type' => 'Freddo',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      DB::table('sandwiches')->insert([
        'name' => 'Brioche alla crema',
        'price' => '0.80',
        'description' => 'Brioche alla crema',
        'type' => 'Freddo',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      DB::table('sandwiches')->insert([
        'name' => 'Brioche al cioccolato',
        'price' => '0.80',
        'description' => 'Brioche al cioccolato',
        'type' => 'Freddo',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      DB::table('sandwiches')->insert([
        'name' => 'Panino al salame',
        'price' => '1.00',
        'description' => 'Panino al salame',
        'type' => 'Freddo',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      DB::table('sandwiches')->insert([
        'name' => 'Panino al cotto',
        'price' => '1.00',
        'description' => 'Panino al prosciutto cotto',
        'type' => 'Freddo',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      DB::table('sandwiches')->insert([
        'name' => 'Filoncino',
        'price' => '1.30',
        'description' => 'Filoncino',
        'type' => 'Freddo',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      //Ingredients

      DB::table('ingredients')->insert([
        'name' => 'Prosciutto cotto',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);

      DB::table('ingredients')->insert([
        'name' => 'Prosciutto crudo',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);

      DB::table('ingredients')->insert([
        'name' => 'Salsa ai funghi',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);

      DB::table('ingredients')->insert([
        'name' => 'Salamino',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);

      DB::table('ingredients')->insert([
        'name' => 'Pomodoro',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      
      DB::table('ingredients')->insert([
        'name' => 'Mozzarella',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);

      DB::table('ingredients')->insert([
        'name' => 'Funghi',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      
      DB::table('ingredients')->insert([
        'name' => 'Würstel',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
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

      // Settings

      DB::table('system_settings')->insert([
        'id' => '1',
      ]);
    }
}
