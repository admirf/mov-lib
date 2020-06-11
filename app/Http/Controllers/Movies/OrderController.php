<?php

namespace App\Http\Controllers\Movies;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Movie;
use App\Order;
use App\User;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        return OrderResource::collection($user->orders()->paginate());
    }

    public function order(Movie $movie)
    {
        /** @var User $user */
        $user = auth()->user();

        $statuses = ['waiting', 'shipped'];
        $months = rand(1, 12);

        $order = new Order([
            'status' => $statuses[rand(0, 1)],
            'charge' => 2 * $months,
            'arrives_at' => now()->addMonths($months)
        ]);

        $order->user()->associate($user);
        $order->movie()->associate($movie);
        $order->save();

        return (new OrderResource($order))->response()->setStatusCode(201);
    }
}
