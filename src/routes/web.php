<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\BandController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\SongController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/artists', [ArtistController::class, 'list']);

Route::get('/artists/create', [ArtistController::class, 'create']);
Route::post('/artists/put', [ArtistController::class, 'put']);

Route::get('/artists/update/{artist}', [ArtistController::class, 'update']);
Route::post('/artists/patch/{artist}', [ArtistController::class, 'patch']);

Route::post('/artists/delete/{artist}', [ArtistController::class, 'delete']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/songs', [SongController::class, 'list']);

Route::get('/songs/create', [SongController::class, 'create']);
Route::post('/songs/put', [SongController::class, 'put']);

Route::get('/songs/update/{song}', [SongController::class, 'update']);
Route::post('/songs/patch/{song}', [SongController::class, 'patch']);

Route::post('/songs/delete/{song}', [SongController::class, 'delete']);

Route::get('/albums', [AlbumController::class, 'list']);

Route::get('/albums/create', [AlbumController::class, 'create']);
Route::post('/albums/put', [AlbumController::class, 'put']);

Route::get('/albums/update/{album}', [AlbumController::class, 'update']);
Route::post('/albums/patch/{album}', [AlbumController::class, 'patch']);

Route::post('/albums/delete/{album}', [AlbumController::class, 'delete']);


// Data/API
Route::get('/data/get-top-songs', [DataController::class, 'getTopSongs']);
Route::get('/data/get-song/{song}', [DataController::class, 'getSong']);
Route::get('/data/get-related-songs/{song}', [DataController::class, 'getRelatedSongs']);
