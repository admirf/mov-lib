<?php

namespace App\Http\Controllers\Movies;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Movie;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }

    public function index(Movie $movie)
    {
        return ReviewResource::collection($movie->reviews()->paginate());
    }

    public function store(Request $request, Movie $movie)
    {
        $payload = $this->validator($request->all())->validate();

        /** @var User $user */
        $user = auth()->user();

        if ($movie->reviews()->where('user_id', $user->id)->exists()) {
            return response()
                ->json([
                    'error' => [
                        'message' => 'You already reviewed this movie.'
                    ]
                ])
                ->setStatusCode(400);
        }

        $review = new Review($payload);
        $review->user()->associate($user);
        $review->movie()->associate($movie);
        $review->save();

        return (new ReviewResource($review))->response()->setStatusCode(201);
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);

        $review->delete();

        return response('', 204);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'rating' => 'required|integer|min:0|max:10',
            'content' => 'required|string|max:1023'
        ]);
    }
}
