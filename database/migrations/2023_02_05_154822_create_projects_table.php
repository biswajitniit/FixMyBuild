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
            //$table->unsignedBigInteger('project_address_id');
            $table->string('builder_category_id')->nullable();
            $table->string('builder_subcategory_id')->nullable();
            $table->string('forename')->nullable();
            $table->string('surname')->nullable();
            $table->string('project_name')->nullable();
            $table->longText('description')->nullable();
            $table->string('contact_mobile_no')->nullable();
            $table->string('contact_home_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('categories')->nullable();
            $table->string('subcategories')->nullable();
            $table->enum('status',['submitted_for_review','returned_for_review','estimation','project_started','awaiting_your_review'])->default('submitted_for_review');
            $table->string('reviewer_status')->nullable();
            $table->dateTime('reviewer_status_updated_at')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('project_address_id')->references('id')->on('projectaddresses')->onDelete('cascade');
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
