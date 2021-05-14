<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeletedChequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deleted_cheques', function (Blueprint $table) {
            $table->id();
            $table->string('chequeNo');
            $table->unsignedBigInteger('payment_id');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->unsignedBigInteger('agent_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('agent_id')->references('id')->on('agents');
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->string('frontImg');
            $table->string('backImg');
            $table->string('agent_Note')->nullable();
            $table->string('admin_Note')->nullable();
            $table->string('created_Date');
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
        Schema::dropIfExists('deleted_cheques');
    }
}
