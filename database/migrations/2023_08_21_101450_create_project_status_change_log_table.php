<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectStatusChangeLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_status_change_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->morphs('action_by');
            $table->string('status', 20);
            $table->dateTime('status_changed_at')->default(now());
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
        Schema::dropIfExists('project_status_change_log');
    }
}
