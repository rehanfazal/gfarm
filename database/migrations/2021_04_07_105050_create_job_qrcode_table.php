<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobQrcodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_qrcode', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('job_id');
            $table->integer('sp_id');
            $table->integer('user_id');
            $table->integer('qrcode_type');
            $table->string('qrcode_path');
            $table->string('qrcode_value');
            $table->boolean('status');
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
        Schema::dropIfExists('job_qrcode');
    }
}
