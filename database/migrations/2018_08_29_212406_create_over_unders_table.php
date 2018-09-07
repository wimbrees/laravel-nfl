<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOverUndersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('over_under', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->decimal('line', 4, 1);
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
        Schema::dropIfExists('over_under');
    }
}
