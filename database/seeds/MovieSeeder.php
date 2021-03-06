<?php

use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = file_get_contents(database_path('json/movies.json'));
        $json = collect(json_decode($file, true));

        $genres = [];

        $json->each(function ($item) use (&$genres) {
            if (! is_null($item['Title'])) {
                App\Movie::create([
                    'title' => $item['Title'],
                    'cover_url' => config('app.url').'/storage/placeholder.png',
                    'gross' => $item['Worldwide_Gross'],
                    'budget' => $item['Production_Budget'],
                    'release_date' => $item['Release_Date'],
                    'mpaa_rating' => $item['MPAA_Rating'],
                    'distributor' => $item['Distributor'],
                    'genre' => $item['Major_Genre'],
                    'director' => $item['Director'],
                    'rotten_tomatoes_rating' => $item['Rotten_Tomatoes_Rating'],
                    'imdb_rating' => $item['IMDB_Rating']
                ]);

                if (! is_null($item['Major_Genre']) && ! in_array($item['Major_Genre'], $genres)) {
                    array_push($genres, $item['Major_Genre']);
                }
            }
        });

        foreach ($genres as $genre) {
            App\Genre::create([
                'name' => $genre
            ]);
        }
    }
}
