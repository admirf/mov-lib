<?php

namespace App\Http\Controllers\Genres;

use App\Genre;
use App\Http\Controllers\Controller;
use App\Http\Resources\GenreResource;

class GenreController extends Controller
{
    public function __invoke()
    {
        return GenreResource::collection(Genre::all());
    }
}
