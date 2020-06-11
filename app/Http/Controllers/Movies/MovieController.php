<?php

namespace App\Http\Controllers\Movies;

use App\Http\Controllers\Controller;
use App\Http\Resources\MovieResource;
use App\Movie;

class MovieController extends Controller
{
    public function index()
    {
        return MovieResource::collection(Movie::paginate());
    }

    public function show(Movie $movie)
    {
        return new MovieResource($movie);
    }
}
