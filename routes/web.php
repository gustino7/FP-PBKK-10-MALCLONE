<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserAnimeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\UserController;
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

// Role Guest
Route::get('/profile/{username}', [UserController::class, 'show'])->name('user.profile');
Route::get('/thumbnail/{filename}', [ProfileController::class, 'thumbnail'])->name('thumbnail');
Route::get('/dashboard', [AnimeController::class, 'getAllDashboard'])->name('dashboard');
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Role Admin
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    // Anime
    Route::get('/anime/create', [AnimeController::class, 'create'])->name('anime.create');
    Route::post('/anime', [AnimeController::class, 'store'])->name('anime.store');

    // Character
    Route::get('/character/create', [CharacterController::class, 'create'])->name('characters.create');
    Route::post('/characters', [CharacterController::class, 'store'])->name('characters.store');
    Route::get('/anime/{anime}/characters/createconnection', [CharacterController::class, 'createConnection'])->name('anime.characters.createconnection');
    Route::post('/anime/{anime}/characters', [CharacterController::class, 'storeconnection'])->name('anime.characters.store');
    
    // Songs
    Route::get('/anime/{anime}/songs/create', [SongController::class, 'create'])->name('songs.create');
    Route::post('/anime/{anime}/songs', [SongController::class, 'store'])->name('songs.store');
});

// Role User
Route::middleware(['auth', 'verified'])->group(function () {
    // REVIEW
    Route::get('/review/create/{anime_id}/{user_id}', [ReviewController::class, 'show'])->name('review.create');
    Route::post('/review/create', [ReviewController::class, 'create'])->name('review.store');
    Route::put('/review/update', [ReviewController::class, 'update'])->name('review.update');
    Route::get('/review/{id}', [ReviewController::class, 'get'])->name('review.show');
    Route::get('/review/all/{id}', [ReviewController::class, 'getAll'])->name('review.showAll');

    // ANIME
    Route::get('/topanime', [AnimeController::class, 'index'])->name('topanime');
    Route::get('/anime/{id}', [AnimeController::class, 'show'])->name('anime.show');
    Route::post('/anime/addlist/{id}', [UserAnimeController::class,'addToList'])->name('anime.addlist');
    Route::post('/anime/removelist/{id}', [UserAnimeController::class,'removeToList'])->name('anime.removelist');
    Route::get('/anime/season/{year}/{season}', [AnimeController::class, 'seasonalAnime'])->where(['year' => '\d{4}', 'season' => 'winter|spring|summer|fall'])->name('anime.season');

    // Community
    Route::get('/community', function () {
        return view('community');
    })->name('community');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/upload-profile-picture', [ProfileController::class, 'uploadProfilePicture'])->name('upload.profile_picture');
});

require __DIR__ . '/auth.php';
