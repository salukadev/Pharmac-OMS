<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculatedCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculated_commissions', function (Blueprint $table) {
            $table->id('commisionId');
            $table->unsignedBigInteger('agentId');
            $table->foreign('agentId')->references('agentId')->on('agents');
            $table->unsignedBigInteger('ruleId');
            $table->foreign('ruleId')->references('ruleId')->on('commission_rules');
            $table->double('points');
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
        Schema::dropIfExists('calculated_commissions');
    }
}
