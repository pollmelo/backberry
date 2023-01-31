<?php

use App\Http\Controllers\PollController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('polls')->group(function () {
    Route::post('/create', [PollController::class, 'create']);
});

Route::prefix('votes')->group(function () {
    Route::post('/create', [VoteController::class, 'create'])->name('votes.create');
});

