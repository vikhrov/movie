<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Services\MovieService;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index()
    {
        $movies = Movie::paginate(10);

        return response()->json($movies);
    }

    public function store(Request $request)
    {
        $validatedData = $this->movieService->validateMovie($request);

        $posterPath = $this->movieService->handlePosterUpload($request->file('poster'));

        $movie = $this->movieService->createMovie($validatedData, $posterPath);

        return response()->json($movie, 201);
    }

    public function show(Movie $movie)
    {
        return response()->json($movie);
    }

    public function update(Request $request, Movie $movie)
    {
        $validatedData = $this->movieService->validateMovie($request);

        $posterPath = null;
        if ($request->hasFile('poster')) {
            $posterPath = $this->movieService->handlePosterUpload($request->file('poster'));
        }

        $movie = $this->movieService->updateMovie($movie, $validatedData, $posterPath);

        return response()->json($movie);
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

}




