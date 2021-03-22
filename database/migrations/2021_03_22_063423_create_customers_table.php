<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id('userId');
            $table->string('name');
            $table->string('approvalStatus')->default('Pending');
            $table->string('telephone');
            $table->double('creditLimit')->default('1000');
            $table->unsignedBigInteger('agentId');
            $table->foreign('agentId')->references('agentId')->on('agents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
