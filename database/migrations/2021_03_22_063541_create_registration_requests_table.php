<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_requests', function (Blueprint $table) {
            $table->id('requestId');
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('userId')->on('users');
            $table->string('name');
            $table->string('address');
            $table->string('customerType');
            $table->string('telephone');
            $table->string('status')->default('Processing');
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
        Schema::dropIfExists('registration_requests');
    }
}
