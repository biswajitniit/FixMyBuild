<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('tradesperson_id')->constrained('users')->onDelete('cascade');
            $table->boolean('project_awarded')->default(false);
            $table->string('status',20)->nullable()->comment('rejected, awarded, trader_rejected');
            $table->string('describe_mode', 50)->comment('Fully_describe,Unable_to_describe');
            $table->string('unable_to_describe_type', 50)->comment('Need_more_info,Do_not_undertake_project_type,Do_not_cover_location')->nullable();
            $table->text('more_info')->nullable();
            $table->boolean('covers_customers_all_needs')->default(false);
            $table->boolean('payment_required_upfront')->default(false);
            $table->boolean('apply_vat')->default(false);
            $table->double('contingency', 10, 2)->nullable();
            $table->string('initial_payment', 10)->nullable();
            $table->string('initial_payment_type', 20)->comment('Fixed, Percentage')->nullable();
            $table->string('project_start_date_type', 30)->nullable();
            $table->date('project_start_date')->nullable();
            $table->string('total_time', 10)->nullable();
            $table->string('total_time_type', 10)->nullable();
            $table->text('terms_and_conditions')->nullable();
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
        Schema::dropIfExists('estimates');
    }
}
