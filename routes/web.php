<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpotifyApiController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Http;
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

Route::get('/', function () { return view('welcome'); })->name('welcome');
Route::get('/create', function () { return view('create_playlist'); });

Route::get('/songrequest', function () { return view('songrequest'); });

/**Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
**/


Route::get('/login/spotify',[AuthController::class,'redirectToSpotify'])->name('spotify.login');
Route::get('/login/spotify/callback',[AuthController::class,'handleSpotifyCallback']);
Route::get('/playlist',[SpotifyApiController::class,'getQueue'])->name('currentList');
Route::post('/create-playlist', [SpotifyApiController::class, 'createPlaylist'])->name('create-playlist');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
