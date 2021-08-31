<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('game_id');
            $table->string('name');
            $table->string('start_date');
            $table->string('duration');
            $table->string('entry_fee');
            $table->string('admin_percent');
            $table->string('w1_percent');
            $table->string('w2_percent');
            $table->string('w3_percent');
            $table->string('collected_amount')->nullable()->default('0');
            $table->string('status')->nullable()->default('0');
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
        Schema::dropIfExists('tournaments');
    }
}
