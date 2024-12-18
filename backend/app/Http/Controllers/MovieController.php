<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    // Tampilkan semua film
    public function index(Request $request)
    {
        $query = Movie::with('category', 'detail');

        if ($request->has('filter')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->input('filter'));
            });
        }

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%');
        }

        $movies = $query->get();
        return response()->json($movies);
    }

    // Simpan film baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'category_id' => 'required|exists:categories,id',
            'thumbnail_url' => 'nullable|url',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:1',
            'rating' => 'nullable|numeric|min:0|max:10',
        ]);

        $movie = Movie::create($validated);

        if ($request->hasAny(['description', 'duration', 'rating'])) {
            $movie->detail()->create($request->only('description', 'duration', 'rating'));
        }

        return response()->json(['message' => 'Movie and details created successfully', 'data' => $movie->load('detail')]);
    }

    // Tampilkan detail film berdasarkan ID
    public function show($id)
    {
        $movie = Movie::with('category', 'detail')->findOrFail($id);
        return response()->json($movie);
    }

    // Update film
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'category_id' => 'required|exists:categories,id',
            'thumbnail_url' => 'nullable|url',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:1',
            'rating' => 'nullable|numeric|min:0|max:10',
        ]);

        $movie->update($validated);

        if ($request->hasAny(['description', 'duration', 'rating'])) {
            $movie->detail()->updateOrCreate(
                ['movie_id' => $movie->id],
                $request->only('description', 'duration', 'rating')
            );
        }

        return response()->json(['message' => 'Movie and details updated successfully', 'data' => $movie->load('detail')]);
    }

    // Hapus film
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return response()->json(['message' => 'Movie deleted successfully']);
    }
}
