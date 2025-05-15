<?php

namespace App\Http\Controllers;

use App\Http\Requests\SongRequest;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class SongController extends Controller
{
    // call auth middleware
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    public function list(): View
    {
        $items = Song::orderBy('name', 'asc')->get();
    
        return view(
            'song.list',
            [
                'title' => 'Songs',
                'items' => $items
            ]
        );
    }

    public function create(): View
    {
        $artists = Artist::orderBy('name', 'asc')->get();
        $albums = Album::orderBy('title', 'asc')->get();
    
        return view(
            'song.form',
            [
                'title' => 'Add song',
                'song' => new Song(),
                'artists' => $artists,
                'albums' => $albums,
            ]
        );
    } 

    // validate and save a band 
    private function saveBandData(Song $song, SongRequest $request): void {
        // validation in BandRequest.php
        $validatedData = $request->validated();

        $song->fill($validatedData);
        $song->display = (bool) ($validatedData['display'] ?? false);

        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid();
            $song->image =  $uploadedFile->storePubliclyAs(
                '/', 
                $name . '.' . $extension, 
                'uploads'
            );
        }

        $song->save();
    }

    // create new Band entry
    public function put(SongRequest $request): RedirectResponse
    {
        $song = new Song();
        $this->saveBandData($song, $request); 
        return redirect('/songs');
    }

    // display Band edit form
    public function update(Song $song): View
    {
        $artists = Artist::orderBy('name', 'asc')->get();
    
        return view(
            'song.form',
            [
                'title' => 'Edit song',
                'song' => $song,
                'artists' => $artists,
            ]
        );
    }
    
    // update Band data
    public function patch(Song $song, SongRequest $request): RedirectResponse
    {
        $this->saveBandData($song, $request);
        return redirect('/songs');
    }

    public function delete(Song $song): RedirectResponse
    {
        if ($song->image) {
            unlink(getcwd() . '/images/' . $song->image);
        }

        $song->delete();
        return redirect('/songs');
    }
}
