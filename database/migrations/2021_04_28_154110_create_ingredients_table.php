<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('nume');
            $table->string('UM');
            $table->foreignId('categorii_ingredient_id');
            $table->timestamps();
            $table->boolean('is_active');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->boolean('is_visible')->default(true);
        });

//        DB::statement("alter table ingredients add constraint chk_ingredient check(LOWER(tip) IN ('mezeluri','carne','peste','legume/fructe','seminte/nuci','cereale','condimente','lactate','branzeturi','dulciuri','bauturi','semipreparate','ready-to-eat','uleioase','sosuri','paine','gustari','suplimente','altele'))");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
}
