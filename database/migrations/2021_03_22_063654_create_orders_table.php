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
            $table->id('orderId');
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('userId')->on('users');
            $table->unsignedBigInteger('cartId');
            $table->foreign('cartId')->references('cartId')->on('carts');
            $table->string('type')->default('Manual');
            $table->string('status');
            $table->unsignedBigInteger('paymentId');
            $table->foreign('paymentId')->references('paymentId')->on('payments');
            $table->double('amount');
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
        Schema::dropIfExists('orders');
    }
}
