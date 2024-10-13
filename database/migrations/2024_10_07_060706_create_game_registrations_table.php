<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid')->default(0);
            $table->string('username')->default('');
            $table->string('email')->default('');
            $table->string('password')->default('');
            $table->unsignedBigInteger('upsponserid')->default(0);
            $table->string('upsponserid_username')->default('');
            $table->unsignedBigInteger('dsponserid')->default(0);
            $table->string('dsponserid_username')->default('');
            $table->unsignedInteger('total_spin_clicked')->default(0);
            $table->unsignedInteger('total_reward_tokens')->default(0);
            $table->date('joindate')->default(now()->toDateString());
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
        Schema::dropIfExists('game_registrations');
    }
}
