<?php

use App\Http\Controllers\ProfileController;
use App\Models\Measurment;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use PHPUnit\Metadata\Uses;
use App\Models\FavoriteStation;
use App\Models\Category;
use App\Models\Coordinates;
use App\Models\MeasuredUnit;
use App\Models\Station;
use App\Models\MQTTServers;
use App\Models\OptimalValue;
use App\Models\MQTTUnit;

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
    return view('db_tables.categories', ['categories' => $categories]);
});

Route::get('/coordinates', function() {
    $coordinates = Coordinates::all();
    return view('db_tables.coordinates', ['coordinates' => $coordinates]);
});

Route::get('/favorite-stations', function() {
    $favoriteStations = FavoriteStation::all();
    return view('db_tables.favorite-stations', ['favoriteStations' => $favoriteStations]);
});

Route::get('/mqtt-servers', function() {
    $mqttServers = MQTTServers::all();
    return view('db_tables.mqtt-servers', ['mqttServers' => $mqttServers]);
});

Route::get('/mqtt-units', function() {
    $mqttUnits = MQTTUnit::all();
    return view('db_tables.mqtt-units', ['mqttUnits' => $mqttUnits]);
});

Route::get('/measured-units', function() {
    $measuredUnits = MeasuredUnit::all();
    return view('db_tables.measured-units', ['measuredUnits' => $measuredUnits]);
});

Route::get('/measurements', function() {
    $measurements = Measurment::paginate(20);
    return view('db_tables.measurements', ['measurements' => $measurements]);
});

Route::get('/optimal-values', function() {
    $optimalValues = OptimalValue::all();
    return view('db_tables.optimal-values', ['optimalValues' => $optimalValues]);
});

Route::get('/stations', function() {
    $stations = Station::all();
    return view('db_tables.stations', ['stations' => $stations]);
});
require __DIR__.'/auth.php';
