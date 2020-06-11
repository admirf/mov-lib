<?php

namespace App\Http\Controllers\Movies;

use App\Http\Controllers\Controller;
use App\Http\Resources\MovieResource;
use App\Movie;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = Movie::query();

        $searchFields = Movie::searchFields();

        $searchFields->each(function ($item) use (&$query, $request) {
            if ($request->has($item['field'])) {
                $query = $this->addQuery($query, $item, $request->get($item['field']));
            }
        });

        return MovieResource::collection($query->paginate());
    }

    protected function addQuery($query, $item, $value)
    {
        if ($item['strict']) {
            return $query->where($item['field'], $value);
        }

        return $query->where($item['field'], 'LIKE', "%$value%");
    }
}
