<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('rate_id');
            $table->unsignedBigInteger('assessment_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('rate', 8, 2)->nullable();
            $table->string('note')->nullable();
            $table->string('status',30)->nullable();
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('rate_id')->references('id')->on('rates');
            $table->foreign('assessment_id')->references('id')->on('assessments');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('rate_answers');
    }
};
