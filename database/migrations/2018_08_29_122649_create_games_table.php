<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('week_id');
            $table->unsignedInteger('away_id');
            $table->unsignedInteger('home_id');
            $table->unsignedInteger('away_score')->default(0);
            $table->unsignedInteger('home_score')->default(0);
            $table->boolean('scored')->default(false);
            $table->timestamps();

            $table->foreign('week_id')
                ->references('id')->on('weeks')->onDelete('cascade');

            $table->foreign('away_id')
                ->references('id')->on('teams')->onDelete('cascade');

            $table->foreign('home_id')
                ->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('games');
    }
}
