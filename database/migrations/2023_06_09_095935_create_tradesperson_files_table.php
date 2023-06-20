<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradespersonFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradesperson_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tradesperson_id')->constrained('users')->onDelete('CASCADE');
            $table->string('file_related_to', 50)->comment('company_logo,public_liability_insurance,trader_img,company_address,team_img,prev_project_img');
            $table->string('file_type', 10)->comment('document,image');
            $table->string('file_name', 255);
            $table->string('file_extension', 10);
            $table->string('url', 255);
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
        Schema::dropIfExists('tradesperson_files');
    }
}
