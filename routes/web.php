<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/anime', function () {
    return view('anime');
})->middleware(['auth', 'verified'])->name('anime');

Route::get('/searchanime', function () {
    return view('searchanime');
})->middleware(['auth', 'verified'])->name('searchanime');

Route::get('/topanime', [AnimeController::class, 'index'])->name('topanime');

Route::get('/seasonalanime', function () {
    return view('seasonalanime');
})->middleware(['auth', 'verified'])->name('seasonalanime');

Route::get('/community', function () {
    return view('community');
})->middleware(['auth', 'verified'])->name('community');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/upload-profile-picture', [ProfileController::class, 'uploadProfilePicture'])->name('upload.profile_picture');
});

Route::get('/thumbnail/{filename}', [ProfileController::class, 'thumbnail'])->name('thumbnail');

require __DIR__ . '/auth.php';
