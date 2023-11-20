<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', [AnimeController::class, 'getAllDashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/anime', function () {
//     return view('anime');
// })->middleware(['auth', 'verified'])->name('anime');

// Route::get('/searchanime', function () {
//     return view('searchanime');
// })->middleware(['auth', 'verified'])->name('searchanime');

// Route::get('/topanime', [AnimeController::class, 'index'])->name('topanime');
// Route::get('/anime/create', [AnimeController::class, 'create'])->name('anime.create');
// Route::post('/anime', [AnimeController::class, 'store'])->name('anime.store');
// Route::get('/anime/{id}', [AnimeController::class, 'show'])->name('anime.show');

// Route::get('/anime/season/{year}/{season}', [AnimeController::class, 'seasonalAnime'])
//     ->where(['year' => '\d{4}', 'season' => 'winter|spring|summer|fall'])
//     ->name('anime.season');



// Route::get('/community', function () {
//     return view('community');
// })->middleware(['auth', 'verified'])->name('community');


Route::middleware(['auth','verified'])->group(function () {
    Route::get('/dashboard', [AnimeController::class, 'getAllDashboard'])->name('dashboard');
    
    // REVIEW
    Route::get('/review/create/{anime_id}/{user_id}', [ReviewController::class, 'show'])->name('review.create');
    Route::post('/review/create', [ReviewController::class, 'create']) ->name('review.store');
    Route::put('/review/update', [ReviewController::class,'update']) ->name('review.update');
    
    // ANIME
    Route::get('/anime', function () {return view('anime');})->name('anime');
    Route::get('/searchanime', function () {return view('searchanime');})->name('searchanime');
    Route::get('/topanime', [AnimeController::class, 'index'])->name('topanime');
    Route::get('/anime/create', [AnimeController::class, 'create'])->name('anime.create');
    Route::post('/anime', [AnimeController::class, 'store'])->name('anime.store');
    Route::get('/anime/{id}', [AnimeController::class, 'show'])->name('anime.show');
    Route::get('/anime/season/{year}/{season}', [AnimeController::class, 'seasonalAnime'])->where(['year' => '\d{4}', 'season' => 'winter|spring|summer|fall'])->name('anime.season');
    
    // Community
    Route::get('/community', function () {return view('community');})->name('community');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/upload-profile-picture', [ProfileController::class, 'uploadProfilePicture'])->name('upload.profile_picture');
});

Route::get('/profile/{username}', [UserController::class, 'show'])->name('user.profile');

Route::get('/thumbnail/{filename}', [ProfileController::class, 'thumbnail'])->name('thumbnail');

require __DIR__ . '/auth.php';
