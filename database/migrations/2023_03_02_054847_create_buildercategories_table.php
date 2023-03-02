<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildercategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildercategories', function (Blueprint $table) {
            $table->id();
            $table->string('builder_category_name')->unique();
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
        Schema::table('buildercategories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
