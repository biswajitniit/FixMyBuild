<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempmediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempmedia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->string('sessionid')->nullable();
            $table->string('file_type', 10);
            $table->string('media_type', 30)->nullable()->default('customer')->comment('customer,tradesperson,project,null');
            $table->string('file_related_to', 50)->comment('company_logo,public_liability_insurance,trader_img,company_address,team_img,prev_project_img');
            $table->string('file_original_name')->nullable();
            $table->string('filename')->nullable();
            $table->string('file_extension')->nullable();
            $table->string('url')->nullable();
            $table->date('file_created_date');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tempmedia');
    }
}
