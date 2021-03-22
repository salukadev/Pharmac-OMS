<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecurringOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurring_orders', function (Blueprint $table) {
            $table->id('roleId');
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('userId')->on('users');
            $table->unsignedBigInteger('cartId');
            $table->foreign('cartId')->references('cartId')->on('carts');
            $table->integer('frequency');
            $table->dateTimeTz('endDate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recurring_orders');
    }
}
