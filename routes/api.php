<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Models\Station;
use Illuminate\Support\Facades\DB;
use App\Exports\StationStartTimeWithData;
use App\Models\Measurment;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


/*curl -X GET "http://127.0.0.1:8000/api/report1" -H "Accept: application/json"*/
Route::get('/report1', function () {

    $results = DB::select(
        "SELECT s.name,
                MIN(m.Measurement_Time) AS start_working_at,
                ARRAY_AGG(DISTINCT mu.Title) AS titles
            FROM Measurment m
            JOIN Measured_Unit mu ON mu.ID_Measured_Unit = m.ID_Measured_Unit
            JOIN Station s ON m.ID_Station = s.ID_Station
                 GROUP BY s.name;"
    );

    return response()->json($results);
});
/*curl -X GET "http://127.0.0.1:8000/api/report2?id_station=0002&start_time=2022-08-02T16:04&end_time=2022-08-02T16:32" -H "Accept: application/json"*/
Route::get('/report2', function (Request $request) {

    $validatedData = $request->validate([
        'start_time' => 'required|date|before_or_equal:end_time',
        'end_time' => 'required|date|after_or_equal:start_time',
    ]);

    $start_time = \Carbon\Carbon::parse($validatedData['start_time'])->format('Y-m-d H:i:s');
    $end_time = \Carbon\Carbon::parse($validatedData['end_time'])->format('Y-m-d H:i:s');

    $results = DB::select(
        "SELECT s.name, mu.Title,
                ROUND(AVG(m.Measurement_Value), 2) AS avg_value,
                ROUND(MAX(m.Measurement_Value), 2) AS max_value,
                ROUND(MIN(m.Measurement_Value), 2) AS min_value
            FROM Measurment m
            JOIN Station s ON m.ID_Station = s.ID_Station
            JOIN Measured_Unit mu ON mu.ID_Measured_Unit = m.ID_Measured_Unit
            WHERE m.Measurement_Time BETWEEN ? AND ?
            GROUP BY s.name, mu.Title",
        [
            $start_time,
            $end_time
        ]
    );

    return response()->json($results);
});
