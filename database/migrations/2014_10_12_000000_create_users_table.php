<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('prenume');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('first_time')->default(true);
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_active')->default(true);
            $table->date('data_nasterii')->nullable();
            $table->integer('greutate')->nullable();
            $table->integer('inaltime')->nullable();
            $table->integer('grad_activitate')->nullable();
            $table->boolean('sex')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::statement('alter table users add constraint chk_gr_activ check(grad_activitate between 1 and 5)');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
