<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'gross',
        'budget',
        'release_date',
        'mpaa_rating',
        'distributor',
        'genre',
        'director',
        'rotten_tomatoes_rating',
        'imdb_rating'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
