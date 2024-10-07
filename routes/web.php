<?php

use App\Http\Controllers\ProfileController;
use App\Models\FavoriteStation;
use App\Models\Measurment;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use PHPUnit\Metadata\Uses;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    dd(User::all(),FavoriteStation::with('user')->get());

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
