<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('google_id')->nullable();
            $table->string('microsoft_id')->nullable();
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->enum('verified',['0', '1'])->default('0')->comment('0 = not verified, 1= its verified');
            $table->string('verification_code')->nullable();
            $table->enum('locked',['0', '1'])->default('0')->comment('0 = not verified, 1= its verified');
            $table->enum('customer_or_tradesperson', ['Customer', 'Tradesperson'])->comment('Customer,Tradesperson');
            $table->enum('terms_of_service', ['0', '1'])->default('0')->comment('0=not read,1=Read');
            $table->string('profile_image')->nullable();
            $table->string('account_deletion_reason')->nullable();
            $table->tinyInteger('delete_permanently')->default('0');
            //$table->tinyInteger('is_email_verified');
            $table->enum('status', ['Active', 'InActive'])->comment('Active,InActive');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['email', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
