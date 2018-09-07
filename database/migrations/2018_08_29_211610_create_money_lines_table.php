<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyLinesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('money_line', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->decimal('home', 4, 2);
            $table->decimal('away', 4, 2);
            $table->string('won')->nullable();
            $table->timestamps();

            $table->primary('id');
            $table->foreign('id')
                ->references('id')->on('games')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('money_line');
    }
}
