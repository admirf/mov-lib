<?php

namespace App\Http\Controllers\Movies;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Http\Resources\MovieResource;
use App\Movie;
use App\User;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        return MovieResource::collection($user->favoriteMovies()->paginate());
    }

    public function add(Movie $movie)
    {
        /** @var User $user */
        $user = auth()->user();

        $user->favoriteMovies()->syncWithoutDetaching($movie->id);

        return MessageResource::success();
    }

    public function remove(Movie $movie)
    {
        /** @var User $user */
        $user = auth()->user();

        $user->favoriteMovies()->detach($movie->id);

        return MessageResource::success();
    }
}
