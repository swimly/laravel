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
            $table->string('uId')->unique();
            $table->string('card')->unique();
            $table->string('name');
            $table->string('face')->nullable();
            $table->string('birth')->nullable();
            $table->string('email')->unique();
            $table->integer('sex')->default(0);
            $table->integer('status')->default(0);
            $table->string('phone')->nullable();
            $table->string('wechat')->nullable();
            $table->string('QQ')->unique()->nullable();
            $table->string('github')->unique()->nullable();
            $table->string('live')->nullable();
            $table->string('address')->nullable();
            $table->string('password');
            $table->rememberToken();
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
