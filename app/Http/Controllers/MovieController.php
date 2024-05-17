<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;


class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(10);

        return response()->json($movies);
    }

    public function store(Request $request)
    {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'poster' => 'nullable|image',
                'genres' => 'required|array', 
            ]);
        
            if ($request->hasFile('poster')) {
                $posterPath = $request->file('poster')->store('posters');
            } else {
                $posterPath = 'default_poster.jpg';
            }
        
            $movie = Movie::create([
                'title' => $validatedData['title'],
                'poster' => $posterPath,
            ]);
        
            $movie->genres()->attach($validatedData['genres']);
        
            return response()->json($movie, 201); 
    }

    public function show(Movie $movie)
    {
        return response()->json($movie);
    }

    public function update(Request $request, Movie $movie)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable|image',
            'genres' => 'required|array',
        ]);

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters');
        } else {
            $posterPath = $movie->poster;
        }

        $movie->update([
            'title' => $validatedData['title'],
            'poster' => $posterPath,
        ]);

        $movie->genres()->sync($validatedData['genres']);

        return response()->json($movie, 200);
    }
    
        public function publish(Movie $movie)
    {
        $movie->update(['status' => 'published']);

        return response()->json($movie, 200);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json(null, 204);
    }




        public function create()
    {
        $genres = Genre::all(); 
        return view('movies.create', compact('genres'));
    }
}




