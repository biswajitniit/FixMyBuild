<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectaddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectaddresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->unsigned();
            $table->string('address_line_one')->nullable();
            $table->string('address_line_two')->nullable();
            $table->string('town_city')->nullable();
            $table->string('postcode')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('projectaddresses');
    }
}
