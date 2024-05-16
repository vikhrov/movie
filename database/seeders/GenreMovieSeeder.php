<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreMovieSeeder extends Seeder
{
    
    public function run(): void
    {
        $moviesIds = DB::table('movies')->pluck('id');
        $genresIds = DB::table('genres')->pluck('id');

        foreach ($moviesIds as $movieId) {
            $randomGenresIds = $genresIds->random(rand(1, 3))->toArray(); 
            foreach ($randomGenresIds as $genreId) {
                DB::table('genre_movie')->insert([
                    'genre_id' => $genreId,
                    'movie_id' => $movieId,
                ]);
            }
        }
        
    }
}
