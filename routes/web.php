<?php

use App\Http\Controllers\ProfileController;
use App\Models\Measurment;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\select;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    /* dd(DB::select("select * from Coordinates")); */
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
