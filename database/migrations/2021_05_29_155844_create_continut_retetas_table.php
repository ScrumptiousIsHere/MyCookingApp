<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContinutRetetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('continut_retetas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reteta_id')->constrained();
            $table->foreignId('ingredient_id')->constrained();
            $table->integer('cantitate');
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
        Schema::dropIfExists('continut_retetas');
    }
}
