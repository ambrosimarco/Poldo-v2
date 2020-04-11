<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->unsignedbigInteger('user_id');
            $table->unsignedbigInteger('sandwich_id');
            $table->decimal('price', 4, 2);  //Backup del prezzo nel caso in cui venisse cambiato in un secondo momento nella tabella dei sandwiches
            $table->integer('times')->unsigned();
            $table->date('created_at');
            $table->datetime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->primary(array('user_id', 'sandwich_id', 'created_at'));
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('orders');
    }
}
