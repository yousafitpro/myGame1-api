<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('status')->nullable()->default('0');
            $table->string('private_key')->nullable()->default('N/A');
            $table->string('public_key')->nullable()->default('N/A');
            $table->string('api_key')->nullable()->default('N/A');
            $table->string('account_holder_name')->nullable()->default('N/A');
            $table->string('account_user_name')->nullable()->default('N/A');
            $table->string('account_mobile')->nullable()->default('N/A');
            $table->string('account_id')->nullable()->default('N/A');
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
        Schema::dropIfExists('payment_methods');
    }
}
