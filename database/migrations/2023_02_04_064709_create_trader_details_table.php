<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trader_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->unique();
            $table->string('comp_reg_no')->nullable();
            $table->string('txt_comp_name')->nullable();
            $table->string('comp_name')->nullable();
            $table->text('comp_address')->nullable();
            $table->string('trader_name')->nullable();
            $table->longText('comp_description')->nullable();
            $table->string('name')->nullable();
            $table->string('phone_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('phone_office')->nullable();
            $table->string('email')->nullable();
            $table->string('company_role')->nullable();
            $table->string('designation')->nullable();
            $table->boolean('vat_reg')->nullable();
            $table->string('vat_no')->nullable();
            $table->string('vat_comp_name')->nullable();
            $table->text('vat_comp_address')->nullable();
            $table->float('contingency', 8, 2)->nullable();
            $table->string('bnk_account_type')->nullable();
            $table->string('bnk_account_name')->nullable();
            $table->string('bnk_sort_code')->nullable();
            $table->string('bnk_account_number')->nullable();
            $table->boolean('builder_amendment')->default(0)->change();
            $table->json('email_notification')->nullable();
            $table->string('insurance_policy_name')->nullable();
            $table->date('insurance_policy_exp_date')->nullable();
            $table->string('approval_status', 20)->default('Pending')->comment('Pending, Rejected, Approved');
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
        Schema::dropIfExists('trader_details');
    }
}
