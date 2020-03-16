<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePairingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pairings', function (Blueprint $table) {
            $table->unsignedbigInteger('sandwich_id');
            $table->unsignedbigInteger('ingredient_id');
            $table->timestamps();
            $table->primary(array('ingredient_id', 'sandwich_id'));
            $table->foreign('ingredient_id')->references('id')->on('ingredients');
            $table->foreign('sandwich_id')->references('id')->on('sandwiches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pairings');
    }
}
