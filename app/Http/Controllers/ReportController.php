<?php

namespace App\Http\Controllers;

use App\Exports\DataExport;
use App\Exports\StationMeasurementExport;
use App\Models\Measurment;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function Illuminate\Log\log;

class ReportController extends Controller
{
    public function index_station(): View
    {

        /*dd(*/
        /*    Station::with(['station_measurments' => function ($query) {*/
        /*        $query->limit(5);*/
        /*    }])*/
        /*    ->get()*/
        /*,Measurment::take(1)->get()*/
        /*);*/
        return view('reports.station_list_form', ["stations" => Station::all()]);
    }
    public function export_station()
    {
        return Excel::download(new DataExport, 'stations.xlsx');
        /*return Excel::download(new InvoicesExport, 'invoices.csv', \Maatwebsite\Excel\Excel::CSV, [*/
        /*      'Content-Type' => 'text/csv',*/
        /*]);*/
    }
    public function results_from_station_by_tyme(Request $request)
    {
        $validatedData = $request->validate([
            'id_station' => 'required|string|exists:station,id_station',
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
            WHERE s.id_station = ?
            AND m.Measurement_Time BETWEEN ? AND ?
            GROUP BY s.name, mu.Title",
            [
                $validatedData['id_station'],
                $start_time,
                $end_time
            ]
        );

        return Excel::download(new StationMeasurementExport($results), 'station_measurements.xlsx');
    }
}
