<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cheques', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('chequeNo');
            $table->unsignedBigInteger('payment_id');
            $table->string('frontImg');
            $table->string('backImg');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->date('chequeDate');
            $table->string('remark')->nullable();
            $table->string('status')->default('Pending');
            $table->unsignedBigInteger('agent_id');
            $table->string('agent_Note')->nullable();
            $table->foreign('agent_id')->references('id')->on('agents');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('admin_Note')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins');
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
        Schema::dropIfExists('cheques');
    }
}
