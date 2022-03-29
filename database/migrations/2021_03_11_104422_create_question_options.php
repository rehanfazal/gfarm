<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->integer('main_cat_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->integer('q_id')->unsigned();
            $table->integer('time_in_hrs')->default(0);
            $table->string('base_price')->default(0);
            $table->string('option_text')->nullable();
            $table->string('customer_price')->default(0);
            $table->string('retail_product')->default(0);
            $table->string('product_pricing')->default(0);
            $table->string('total_price')->default(0);
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
        Schema::dropIfExists('question_options');
    }
}
