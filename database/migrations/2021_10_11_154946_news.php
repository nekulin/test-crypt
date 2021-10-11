<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class News extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hash', 32)->unique();
            $table->bigInteger('news_source_id')->index();
            $table->string('title', 255)->nullable();
            $table->string('theme', 150)->index();
            $table->string('url', 255);
            $table->string('description', 1000);
            $table->string('content', 5000);
            $table->dateTime('created_at');
            $table->dateTime('date_at')->index();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
