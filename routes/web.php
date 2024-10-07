<?php

use App\Http\Controllers\ProfileController;
use App\Models\Measurment;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use PHPUnit\Metadata\Uses;
use App\Models\FavoriteStation;
use App\Models\Category;
use App\Models\MeasuredUnit;
use App\Models\Station;
use App\Models\MQTTServers;
use App\Models\OptimalValue;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {


    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/categories', function() {
    $categories = Category::all();
    return view('db_tables/categories', ['categories'=>$categories]);
});

Route::get('/favorite-stations', function() {
    $favoriteStations = FavoriteStation::all();
    return view('db_tables/favorite-stations', compact('favoriteStations'));
});

Route::get('/measured-units', function() {
    $measuredUnits = MeasuredUnit::all();
    return view('db_tables/measured-units', compact('measuredUnits'));
});

Route::get('/stations', function() {
    $stations = Station::all();
    return view('db_tables/stations', compact('stations'));
});

Route::get('/mqtt-servers', function() {
    $mqttServers = MQTTServers::all();
    return view('db_tables/mqtt-servers', compact('mqttServers'));
});

Route::get('/optimal-values', function() {
    $optimalValues = OptimalValue::all();
    return view('db_tables/optimal-values', compact('optimalValues'));
});
require __DIR__.'/auth.php';
