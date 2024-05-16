<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        return response()->json(Genre::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:genres,name',
        ]);

        $genre = Genre::create($validatedData);
        return response()->json($genre, 201);
    }

    public function show(Genre $genre)
    {
        $movies = $genre->movies()->paginate(10);
        return response()->json($movies, 200);
    }

    public function update(Request $request, Genre $genre)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,' . $genre->id,
        ]);

        $genre->update($validatedData);
        return response()->json($genre, 200);
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return response()->json(null, 204);
    }
}
