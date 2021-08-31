<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebconfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webconfigs', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable()->default('Company Name');
            $table->string('company_short_name')->nullable()->default('CN');
            $table->string('company_email')->nullable()->default('CompanyEmail@gmail.com');
            $table->string('company_phone')->nullable()->default('+923417414093');
            $table->string('company_address')->nullable()->default('Company Address');
            $table->string('company_logo')->nullable()->default('');
            $table->string('locale')->nullable()->default('en');
            $table->string('backend_navbar_color')->nullable()->default('#2f4050');
            $table->string('backend_navbar_position')->nullable()->default('left');
            $table->string('front_navbar_color')->nullable()->default('#2f4050');
            $table->string('front_navbar_position')->nullable()->default('top');
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
        Schema::dropIfExists('webconfigs');
    }
}
