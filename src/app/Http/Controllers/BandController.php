<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Band;
use App\Http\Requests\BandRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;


class BandController extends Controller implements HasMiddleware
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
        $items = Band::orderBy('name', 'asc')->get();
    
        return view(
            'band.list',
            [
                'title' => 'Bands',
                'items' => $items
            ]
        );
    }

    public function create(): View
    {
        $members = Member::orderBy('name', 'asc')->get();
    
        return view(
            'band.form',
            [
                'title' => 'Add band',
                'band' => new Band(),
                'members' => $members,
            ]
        );
    } 

    // validate and save a band 
    private function saveBandData(Band $band, BandRequest $request): void {
        // validation in BandRequest.php
        $validatedData = $request->validated();

        $band->fill($validatedData);
        $band->display = (bool) ($validatedData['display'] ?? false);

        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid();
            $band->image =  $uploadedFile->storePubliclyAs(
                '/', 
                $name . '.' . $extension, 
                'uploads'
            );
        }

        $band->save();
    }

    // create new Band entry
    public function put(BandRequest $request): RedirectResponse
    {
        $band = new Band();
        $this->saveBandData($band, $request); 
        return redirect('/bands');
    }

    // display Band edit form
    public function update(Band $band): View
    {
        $members = Member::orderBy('name', 'asc')->get();
    
        return view(
            'band.form',
            [
                'title' => 'Edit band',
                'band' => $band,
                'members' => $members,
            ]
        );
    }
    
    // update Band data
    public function patch(Band $band, BandRequest $request): RedirectResponse
    {
        $this->saveBandData($band, $request);
        return redirect('/bands');
    }

    public function delete(Band $band): RedirectResponse
    {
        if ($band->image) {
            unlink(getcwd() . '/images/' . $band->image);
        }

        $band->delete();
        return redirect('/bands');
    }
}