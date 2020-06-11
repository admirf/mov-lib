<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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

    public static function searchFields(): Collection
    {
        return collect([
            [
                'field' => 'title',
                'strict' => false
            ],
            [
                'field' => 'genre',
                'strict' => true
            ],
            [
                'field' => 'director',
                'strict' => false
            ],
            [
                'field' => 'distributor',
                'strict' => false
            ]
        ]);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
