<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffAccsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_accs', function (Blueprint $table) {
            $table->id('staffId');
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('userId')->on('users');
            $table->string('name');
            $table->string('telephone');
            $table->string('department');
            $table->string('accessLevel');
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
        Schema::dropIfExists('staff_accs');
    }
}
