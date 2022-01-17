<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('continut')->nullable();
            $table->integer('nota');
            $table->foreignId('user_id');
            $table->foreignId('reteta_id');
            $table->boolean('is_active');
            $table->timestamps();

        });

        DB::statement('alter table reviews add constraint chk_nota check(nota between 1 and 5)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
