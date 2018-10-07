<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumns extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('user_stats', function (Blueprint $table) {
            $table->dropColumn('fan');
        });

        Schema::table('achievements', function (Blueprint $table) {
            $table->dropColumn('fan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('user_stats', function (Blueprint $table) {
            $table->integer('fan')->default(0);
        });
    }
}
