<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('location')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('phone_verified')->default(0);
            $table->boolean('email_verified')->default(0);
            $table->string('language')->nullable();
            $table->integer('country_id')->nullable();
            $table->boolean('status')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists("user_details");
    }
}
