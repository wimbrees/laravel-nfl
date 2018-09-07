<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserStatsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->decimal('units', 5, 2)->default(100);
            $table->integer('bets_won')->default(0);
            $table->integer('bets_lost')->default(0);
            $table->integer('money_line_won')->default(0);
            $table->integer('money_line_lost')->default(0);
            $table->integer('spread_won')->default(0);
            $table->integer('spread_lost')->default(0);
            $table->integer('over_under_won')->default(0);
            $table->integer('over_under_lost')->default(0);
            $table->integer('achievements')->default(0);
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
        Schema::dropIfExists('user_stats');
    }
}
