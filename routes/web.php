<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserAnimeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudioController;
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
Route::get('/profile/{username}/{status}', [UserController::class, 'animeList'])->name('user.animeList');
Route::get('/thumbnail/{filename}', [ProfileController::class, 'thumbnail'])->name('thumbnail');
Route::get('/dashboard', [AnimeController::class, 'getAllDashboard'])->name('dashboard');

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Role Admin
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    // Anime
    Route::get('/anime/create', [AnimeController::class, 'create'])->name('anime.create');
    Route::post('/anime', [AnimeController::class, 'store'])->name('anime.store');

    // Character
    Route::get('/character/create', [CharacterController::class, 'create'])->name('characters.create');
    Route::post('/characters', [CharacterController::class, 'store'])->name('characters.store');
    Route::get('/characters/{character}', [CharacterController::class, 'showAnimeography'])->name('characters.show');
    Route::get('/anime/{anime}/characters/createconnection', [CharacterController::class, 'createConnection'])->name('anime.characters.createconnection');
    Route::post('/anime/{anime}/characters', [CharacterController::class, 'storeconnection'])->name('anime.characters.store');
    Route::get('/anime/{anime}/characters/all', [CharacterController::class, 'showAll'])->name('anime.characters.all');

    // Staff
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
    Route::get('/staff/{staff}', [StaffController::class, 'showAnimeography'])->name('staff.show');
    Route::get('/anime/{anime}/staff/createConnection', [StaffController::class, 'createConnection'])->name('anime.staff.createConnection');
    Route::post('/anime/{anime}/staff/store', [StaffController::class, 'storeConnection'])->name('anime.staff.store');
    Route::get('/anime/{anime}/staff/all', [StaffController::class, 'showAll'])->name('anime.staff.all');

    // Genre
    Route::get('/anime/{anime}/genre/createConnection', [AnimeController::class, 'createGenreConnection'])->name('genre.createConnection');
    Route::post('/anime/{anime}/genre/storeConnection', [AnimeController::class, 'storeGenreConnection'])->name('genre.store');
    Route::get('/anime/genre/{genre}', [AnimeController::class, 'showAnimeByGenre'])
        ->name('anime.genre');

    // Staff
    Route::get('/studio/create', [StudioController::class, 'create'])->name('studio.create');
    Route::post('/studio/store', [StudioController::class, 'store'])->name('studio.store');
    Route::get('/anime/{anime}/studio/createConnection', [AnimeController::class, 'createStudioConnection'])->name('studio.createConnection');
    Route::post('/anime/{anime}/studio/storeConnection', [AnimeController::class, 'storeStudioConnection'])->name('studio.storeConnection');
    Route::get('/anime/studio/{studio}', [AnimeController::class, 'showByStudio'])->name('anime.studio');
    Route::get('/studio/{studio}', [StudioController::class, 'show'])->name('studio.show');

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
    Route::post('/anime/addlist/{id}', [UserAnimeController::class, 'addToList'])->name('anime.addlist');
    Route::post('/anime/removelist/{id}', [UserAnimeController::class, 'removeToList'])->name('anime.removelist');
    Route::get('/anime/season/{year}/{season}', [AnimeController::class, 'seasonalAnime'])->where(['year' => '\d{4}', 'season' => 'winter|spring|summer|fall'])->name('anime.season');

    // Search
    Route::get('/search', [SearchController::class, 'index'])->name('search.index');

    Route::get('/thumbnail/{filename}', [ProfileController::class, 'thumbnail'])->name('thumbnail');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/upload-profile-picture', [ProfileController::class, 'uploadProfilePicture'])->name('upload.profile_picture');
});

require __DIR__ . '/auth.php';
