<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDigitalPeymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('digital_payments', function (Blueprint $table) {

            $table->bigInteger('transactionId')->primary();
            $table->BigInteger('paymentId');
            $table->foreign('paymentId')->references('paymentId')->on('payments')->onDelete('cascade');
            $table->string('remark',255)->nullable();
            $table->string('status')->default('Pending');
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
        Schema::dropIfExists('digital_peyments');
    }
}
