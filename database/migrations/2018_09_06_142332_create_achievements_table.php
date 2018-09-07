<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchievementsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('achievements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->boolean('mourinhista')->default(false);
            $table->boolean('hat-trick')->default(false);
            $table->boolean('pana')->default(false);
            $table->boolean('underdog')->default(false);
            $table->boolean('elefantes')->default(false);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('achievements');
    }
}
