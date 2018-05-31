<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uId')->nullable();
            $table->string('cover')->nullable();
            $table->integer('status')->default(0);
            $table->string('title');
            $table->string('classify')->nullable();
            $table->string('tag')->nullable();
            $table->string('author')->nullable();
            $table->integer('star')->default(0);
            $table->integer('read')->default(0);
            $table->longText('content');
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
        Schema::dropIfExists('articles');
    }
}
