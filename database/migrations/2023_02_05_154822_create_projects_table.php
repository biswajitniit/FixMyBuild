<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('project_address_id');
            $table->string('forename')->nullable();
            $table->string('surname')->nullable();
            $table->string('project_name')->nullable();
            $table->longText('description')->nullable();
            $table->string('contact_mobile_no')->nullable();
            $table->string('contact_home_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('categories')->nullable();
            $table->enum('Status',['Submitted for review','Returned for review','Estimation','Project started','Awaiting your review'])->default('Submitted for review');
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_address_id')->references('id')->on('projectaddresses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
