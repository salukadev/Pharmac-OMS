<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductListningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_listnings', function (Blueprint $table) {
            $table->id('productId');
            $table->unsignedBigInteger('stockId');
            $table->foreign('stockId')->references('stockId')->on('stocks');
            $table->unsignedBigInteger('catId');
            $table->foreign('catId')->references('catId')->on('categories');
            $table->string('name');
            $table->string('imagePath');
            $table->double('unitPrice');
            $table->unsignedBigInteger('discountId');
            $table->foreign('discountId')->references('discountId')->on('discounts');
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
        Schema::dropIfExists('product_listnings');
    }
}
