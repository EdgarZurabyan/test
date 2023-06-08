<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\NewsFeedController;

Route::get('/news', [NewsFeedController::class, 'index'])->name('news.index');
Route::post('/news/{id}/like', [NewsFeedController::class, 'like'])->name('news.like');
Route::post('/news/{id}/dislike', [NewsFeedController::class, 'dislike'])->name('news.dislike');
