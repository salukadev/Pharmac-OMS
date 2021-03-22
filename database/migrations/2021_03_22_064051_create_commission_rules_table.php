<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_rules', function (Blueprint $table) {
            $table->id('ruleId');
            $table->unsignedBigInteger('author');
            $table->foreign('author')->references('adminId')->on('admins');
            $table->integer('minRefs');
            $table->double('pointPerRef');
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
        Schema::dropIfExists('commission_rules');
    }
}
