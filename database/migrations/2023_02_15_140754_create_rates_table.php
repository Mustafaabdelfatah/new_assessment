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
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assessment_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('manager_id');
            $table->date('date')->nullable();
            $table->decimal('rate', 8, 2)->nullable();
            $table->string('status', 30);
            $table->timestamps();
            $table->foreign('assessment_id')->references('id')->on('assessments');
            $table->foreign('manager_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rates');
    }
};
