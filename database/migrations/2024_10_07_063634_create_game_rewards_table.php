<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_rewards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid')->default(0);
            $table->string('username')->default('');
            $table->string('email')->default('');
            $table->unsignedInteger('total_earn_tokens')->default(0);
            $table->string('source')->default('');
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
        Schema::dropIfExists('game_rewards');
    }
}
