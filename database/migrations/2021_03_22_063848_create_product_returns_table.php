<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_returns', function (Blueprint $table) {
            $table->id('returnId');
            $table->unsignedBigInteger('orderId');
            $table->foreign('orderId')->references('orderId')->on('orders');
            $table->string('reason');
            $table->dateTimeTz('date');
            $table->string('remark');
            $table->string('type');
            $table->string('returnStatus');
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
        Schema::dropIfExists('product_returns');
    }
}
