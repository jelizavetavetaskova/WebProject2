<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Song;

class DataController extends Controller
{
    // Return 3 published Books in random order
    public function getTopSongs(): JsonResponse
    {
        $songs = Song::where('display', true)
            ->inRandomOrder()
            ->take(3)
            ->get();
    
        return response()->json($songs);
    }

    // Return selected Book if it's published
    public function getSong(Song $song): JsonResponse
    {
        $selectedSong = Song::where([
                'id' => $song->id,
                'display' => true,
            ])
            ->firstOrFail();
    
        return response()->json($selectedSong);
    }

    // Return 3 published Books in random order- except the selected Book
    public function getRelatedSongs(Song $song): JsonResponse
    {
        $songs = Song::where('display', true)
            ->where('id', '<>', $song->id)
            // te citas parbaudes
            ->inRandomOrder()
            ->take(3)
            ->get();
    
        return response()->json($songs);
    }

}
