<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id('stockId');
            $table->unsignedBigInteger('supplierId');
            $table->foreign('supplierId')->references('supplierId')->on('suppliers');
            $table->string('batchNo');
            $table->unsignedBigInteger('catId');
            $table->foreign('catId')->references('catId')->on('categories');
            $table->string('name');
            $table->string('brand');
            $table->double('unitPrice');
            $table->dateTimeTz('mnfDate');
            $table->dateTimeTz('expDate');
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
        Schema::dropIfExists('stocks');
    }
}
