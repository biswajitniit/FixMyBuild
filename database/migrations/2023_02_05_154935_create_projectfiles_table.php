<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectfiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('file_type', 10);
            $table->string('filename')->nullable();
            $table->string('file_original_name')->nullable();
            $table->string('file_extension')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projectfiles');
    }
}
