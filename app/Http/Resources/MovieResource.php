<?php

namespace App\Http\Resources;

use App\User;
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
        /** @var User $auth */
        $auth = auth()->user();

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
            'imdbRating' => $this->imdb_rating,
            'favorite' => $this->when((bool) $auth, function () use ($auth) {
                return $auth->favoriteMovies()->where('movie_id', $this->resource->id)->exists();
            }),
            'order' => $this->when((bool) $auth, function () use ($auth) {
                $order = $auth->orders()->where('movie_id', $this->resource->id)->select('id')->first();
                return $order ? [
                    'id' => $order->id
                ]: null;
            })
        ];
    }
}
