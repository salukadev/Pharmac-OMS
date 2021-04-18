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
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->string('reason');
        //    $table->dateTimeTz('date')->nullable();
            $table->string('remark')->nullable();
            $table->string('images')->nullable();
            $table->enum('type', ['Refund', 'Reorder'])->default('Reorder');
        //    $table->string('type');
            $table->enum('returnStatus', ['Pending', 'Processing', 'Completed', 'Rejected'])->default('Pending');
        //    $table->string('returnStatus');
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
