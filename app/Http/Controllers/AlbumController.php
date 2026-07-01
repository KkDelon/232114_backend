<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlbumController extends Controller
{
    /**
     * Create a new AlbumController instance.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::with('format')->get();
        return response()->json($albums);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'format_id' => 'required|exists:formats,id',
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'release_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $album = Album::create($request->all());
        
        return response()->json([
            'message' => 'Album successfully created',
            'album' => $album->load('format')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $album = Album::with('format')->find($id);

        if (!$album) {
            return response()->json(['message' => 'Album not found'], 404);
        }

        return response()->json($album);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $album = Album::find($id);

        if (!$album) {
            return response()->json(['message' => 'Album not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'format_id' => 'sometimes|required|exists:formats,id',
            'title' => 'sometimes|required|string|max:255',
            'artist' => 'sometimes|required|string|max:255',
            'release_year' => 'sometimes|required|integer|min:1900|max:' . (date('Y') + 5),
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $album->update($request->all());

        return response()->json([
            'message' => 'Album successfully updated',
            'album' => $album->load('format')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $album = Album::find($id);

        if (!$album) {
            return response()->json(['message' => 'Album not found'], 404);
        }

        $album->delete();

        return response()->json(['message' => 'Album successfully deleted']);
    }
}
