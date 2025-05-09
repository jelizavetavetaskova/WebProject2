<?php

use App\Http\Controllers\BandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/members', [MemberController::class, 'list']);

Route::get('/members/create', [MemberController::class, 'create']);
Route::post('/members/put', [MemberController::class, 'put']);

Route::get('/members/update/{member}', [MemberController::class, 'update']);
Route::post('/members/patch/{member}', [MemberController::class, 'patch']);

Route::post('/members/delete/{member}', [MemberController::class, 'delete']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/bands', [BandController::class, 'list']);

Route::get('/bands/create', [BandController::class, 'create']);
Route::post('/bands/put', [BandController::class, 'put']);

Route::get('/bands/update/{band}', [BandController::class, 'update']);
Route::post('/bands/patch/{band}', [BandController::class, 'patch']);

Route::post('/bands/delete/{band}', [BandController::class, 'delete']);