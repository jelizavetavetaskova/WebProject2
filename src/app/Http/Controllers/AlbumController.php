<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class AlbumController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    public function list(): View
    {
        $items = Album::orderBy('title', 'asc')->get();
 
        return view(
            'album.list',
            [
                'title' => 'Albums',
                'items' => $items,
            ]
        );
    }

    public function create(): View
    {
        return view(
            'album.form',
            [
                'title' => 'Add album',
                'album' => new Album()
            ]
        );
    }

    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'numeric|nullable'
        ]);
 
        $album = new Album();
        $album->title = $validatedData['title'];
        $album->year = $validatedData['year'];
        $album->save();
 
        return redirect('/albums');
    }

    public function update(Album $album): View
    {
        return view(
            'album.form',
            [
                'title' => 'Edit album',
                'album' => $album
            ]
        );
    }

        // update existing Author data
        public function patch(Album $album, Request $request): RedirectResponse
        {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'year' => 'numeric|nullable'
            ]);
    
            $album->title = $validatedData['title'];
            $album->year = $validatedData['year'];
            $album->save();
    
            return redirect('/albums');
        }

        public function delete(Album $album): RedirectResponse
        {
            $album->delete();
            return redirect('/albums');
        }
}
