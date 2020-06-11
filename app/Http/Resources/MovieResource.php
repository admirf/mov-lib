<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        /*$table->string('title');
        $table->string('cover_url');
        $table->unsignedBigInteger('gross')->nullable();
        $table->unsignedBigInteger('budget')->nullable();
        $table->string('release_date')->nullable();
        $table->string('mpaa_rating')->nullable();
        $table->string('distributor')->nullable();
        $table->string('genre')->nullable();
        $table->string('director')->nullable();
        $table->integer('rotten_tomatoes_rating')->nullable();
        $table->float('imdb_rating')->nullable();*/

        return [
            'type' => 'movie',
            'id' => $this->id,
            'title' => $this->title,
            'coverUrl' => $this->cover_url,
            'gross' => $this->gross,
            'budget' => $this->budget,
            'releaseDate' => $this->release_date,
            'mpaaRating' => $this->mpaa_rating,
            'distributor' => $this->distributor,
            'genre' => $this->genre,
            'director' => $this->director,
            'rottenTomatoesRating' => $this->rotten_tomatoes_rating,
            'imdbRating' => $this->imdb_rating
        ];
    }
}
