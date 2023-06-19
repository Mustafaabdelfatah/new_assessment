<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('rate_actions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status', 30);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('assess_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('rate_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('rate_id')->references('id')->on('rates');
            $table->foreign('assess_id')->references('id')->on('assessments');
            $table->foreign('employee_id')->references('id')->on('users');

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
        Schema::dropIfExists('rate_actions');
    }
};
