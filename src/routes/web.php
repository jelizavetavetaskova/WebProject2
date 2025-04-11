<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/members', [MemberController::class, 'list']);

Route::get('/members/create', [MemberController::class, 'create']);
Route::post('/members/put', [MemberController::class, 'put']);

Route::get('/members/update/{member}', [MemberController::class, 'update']);
Route::post('/members/patch/{member}', [MemberController::class, 'patch']);

Route::post('/members/delete/{member}', [MemberController::class, 'delete']);