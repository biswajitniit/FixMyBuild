<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildersubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildersubcategories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('builder_category_id');
            $table->foreign('builder_category_id')->references('id')->on('buildercategories')->onDelete('cascade');
            $table->string('builder_subcategory_name');
            $table->enum('status', ['Active', 'InActive'])->comment('Active,InActive')->default('Active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buildersubcategories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
