<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\SetDatabaseConnection;
use Illuminate\Support\Facades\Route;
use App\Models\Measurment;
use App\Models\Coordinates;
use App\Models\MeasuredUnit;
use App\Models\Station;
use App\Models\MQTTServers;
use App\Models\OptimalValue;
use App\Http\Controllers\PowerBIController;
use App\Http\Controllers\DataVisualization;
Route::get('/', function () {
    /*$currentConnection = DB::getDefaultConnection();*/
    /*dd($currentConnection);*/
    /*'coordinates' => $coordinates*/
    return view('welcome');
});


Route::middleware(SetDatabaseConnection::class)->group(function () {

    Route::get('/reports', [ReportController::class, "index_station"])->name('report.index_station');
    Route::post('report1/export_xlsx', [ReportController::class, 'export_station_xlsx'])->name('report.report1');;
    Route::post('report1/export_csv', [ReportController::class, 'export_station_csv']);
    Route::post('report1/export_mpdf', [ReportController::class, 'export_station_mpdf']);
    Route::post('report2/export', [ReportController::class, 'results_from_station_by_tyme'])->name('report.results_from_station_by_tyme');


    Route::get('/data_visualization', [DataVisualization::class, "index"])->name('data_visualization.index');
    Route::get('/data_visualization/1', [DataVisualization::class, "visualization1"])->name('data_visualization.1');
    Route::get('/data_visualization/2', [DataVisualization::class, "visualization2"])->name('data_visualization.2');
    Route::get('/data_visualization/3', [DataVisualization::class, "visualization3"])->name('data_visualization.3');
    Route::get('/data_visualization/4', [DataVisualization::class, "visualization4"])->name('data_visualization.4');

    Route::get('/dashboard', function () {
        /*$currentConnection = DB::getDefaultConnection();*/
        /*dd($currentConnection);*/
        /*dd(DB::select("SELECT * FROM information_schema.tables",));*/

        return view('dashboard', ["coordinates" => Coordinates::all()]);
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    });

    Route::get('/mqtt-servers', function () {
        $mqttServers = MQTTServers::all();
        return view('db_tables.mqtt-servers', ['mqttServers' => $mqttServers]);
    });


    Route::get('/measured-units', function () {
        $measuredUnits = MeasuredUnit::all();
        return view('db_tables.measured-units', ['measuredUnits' => $measuredUnits]);
    });

    Route::get('/measurements', function () {
        $measurements = Measurment::with("station")->with("measured_unit")->paginate(20);
        return view('db_tables.measurements', ['measurements' => $measurements]);
    });

    Route::get('/optimal-values', function () {
        $optimalValues = OptimalValue::with("measured_unit")->with("category")->get();
        return view('db_tables.optimal-values', ['optimalValues' => $optimalValues]);
    });

    Route::get('/stations', function () {
        $stations = Station::with("mqtt_servers")->with("coordinates")->get();
        /*dd($stations);*/
        return view('db_tables.stations', ['stations' => $stations, "coordinates" => Coordinates::all()]);
    });
    /*Route::get('/coordinates', function () {*/
    /*    $coordinates = Coordinates::all();*/
    /*    return view('db_tables.coordinates', ['coordinates' => $coordinates]);*/
    /*});*/

    /*Route::get('/favorite-stations', function () {*/
    /*    $favoriteStations = FavoriteStation::all();*/
    /*    dd(FavoriteStation::with("user")->get());*/
    /*    return view('db_tables.favorite-stations', ['favoriteStations' => $favoriteStations]);*/
    /*});*/

    /*Route::get('/categories', function () {*/
    /*    $categories = Category::all();*/
    /*    return view('db_tables.categories', ['categories' => $categories]);*/
    /*});*/
    /*Route::get('/mqtt-units', function () {*/
    /*    $mqttUnits = MQTTUnit::all();*/
    /*    return view('db_tables.mqtt-units', ['mqttUnits' => $mqttUnits]);*/
    /*});*/
});
require __DIR__ . '/auth.php';
