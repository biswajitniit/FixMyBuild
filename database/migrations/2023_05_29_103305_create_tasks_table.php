<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estimate_id')->constrained('estimates')->onDelete('cascade');
            $table->text('description');
            $table->boolean('is_initial')->default(0);
            $table->double('price', 10, 2)->nullable();
            $table->double('contingency', 10, 2)->nullable();
            $table->double('max_contingency', 10, 2)->nullable();
            $table->string('payment_status', 20)->nullable();
            $table->string('status', 20)->nullable();
            $table->string('payment_type', 20)->nullable();
            $table->string('payment_transaction_id', 30)->nullable();
            $table->longText('payment_capture_log')->nullable();
            $table->dateTime('payment_date')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
