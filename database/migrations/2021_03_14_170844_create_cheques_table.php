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
            $table->bigInteger('chequeNo')->primary();
            $table->unsignedBigInteger('paymentId');
            $table->string('frontImg');
            $table->string('backImg');
            $table->foreign('paymentId')->references('paymentId')->on('payments')->onDelete('cascade');
            $table->date('chequeDate');
            $table->string('remark')->nullable();
            $table->string('status')->default('Pending');
            $table->unsignedBigInteger('agentId');
            $table->string('agent_Note')->nullable();
            $table->foreign('agentId')->references('agentId')->on('agents');
            $table->unsignedBigInteger('adminId');
            $table->string('admin_Note')->nullable();
            $table->foreign('adminId')->references('adminId')->on('admins');
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
