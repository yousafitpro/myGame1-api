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
            $table->string('fname')->nullable()->default('');
            $table->string('lname')->nullable()->default('');
            $table->string('phone')->nullable()->default('');
            $table->string('type')->nullable()->default('user');
            $table->string('status')->nullable()->default('0');
            $table->string('address')->nullable()->default('0');
            $table->string('role_id')->nullable()->default('0');
            $table->string('addedby_id')->nullable()->default('0');
            $table->string('profile_image')->nullable()->default('0');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
