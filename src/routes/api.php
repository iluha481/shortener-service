<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Api\LinkController;

Route::post('/links', [LinkController::class, 'store']);
Route::get('/links/{code}/stats', [LinkController::class, 'stats']);