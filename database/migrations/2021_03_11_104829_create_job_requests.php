<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('job_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('description')->nullable();
            $table->string('price')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists("job_requests");
    }
}
