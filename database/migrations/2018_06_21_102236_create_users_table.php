<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('group_id');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->boolean('active')->default(1);
            $table->boolean('logout')->default(0);
            $table->string('name')->unique();
            $table->string('email');
            $table->string('password')->nullable();
            $table->string('pib');
            $table->string('position')->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
