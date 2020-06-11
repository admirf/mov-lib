<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('cover_url');
            $table->unsignedBigInteger('gross')->nullable();
            $table->unsignedBigInteger('budget')->nullable();
            $table->string('release_date')->nullable();
            $table->string('mpaa_rating')->nullable();
            $table->string('distributor')->nullable();
            $table->string('genre')->nullable();
            $table->string('director')->nullable();
            $table->integer('rotten_tomatoes_rating')->nullable();
            $table->float('imdb_rating')->nullable();
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
        Schema::dropIfExists('movies');
    }
}
