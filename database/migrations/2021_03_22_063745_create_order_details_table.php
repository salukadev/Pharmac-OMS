<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->unsignedBigInteger('orderId');
            $table->foreign('orderId')->references('orderId')->on('orders');
            $table->unsignedBigInteger('productId');
            $table->foreign('productId')->references('productId')->on('product_listnings');
            $table->integer('quantity');
            $table->double('calculatedDiscount');
            $table->double('netValue');
            $table->primary(['orderId','productId']);
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
        Schema::dropIfExists('order_details');
    }
}
