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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rate_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('action_id');
            $table->foreign('rate_id')->references('id')->on('rates');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('action_id')->references('id')->on('rate_actions');
            $table->string('note')->nullable();
            $table->string('status', 30);

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
