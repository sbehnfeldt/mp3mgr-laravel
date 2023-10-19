<?php

use App\Http\Controllers\ProfileController;
use App\Models\Mp3File;
use Illuminate\Support\Facades\Auth;
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

    if (auth()->user()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'mp3s' => Mp3File::with('artist')->with( 'album' )->get()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/artists', function () {
    return view('artists');
})->middleware(['auth', 'verified'])->name('artists');

Route::get('/albums', function () {
    return view('albums');
})->middleware(['auth', 'verified'])->name('albums');

Route::get('/details', function () {
    return view('details', [
        'mp3s' => Mp3File::with('artist')->with( 'album' )->get()
    ]);
})->middleware(['auth', 'verified'])->name('details');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
