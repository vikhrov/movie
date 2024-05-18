<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieService
{
    public function validateMovie(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable|image',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
        ]);
    }

    public function handlePosterUpload($poster)
    {
        if ($poster) {
            return $poster->store('posters');
        }
        return 'default_poster.jpg';
    }

    public function createMovie(array $data, $posterPath)
    {
        $movie = Movie::create([
            'title' => $data['title'],
            'poster' => $posterPath,
        ]);

        $movie->genres()->attach($data['genres']);

        return $movie;
    }

    public function updateMovie(Movie $movie, array $data, $posterPath = null)
    {
        if ($posterPath) {
            $movie->poster = $posterPath;
        }

        $movie->update($data);

        if (isset($data['genres'])) {
            $movie->genres()->sync($data['genres']);
        }

        return $movie;
    }
}
