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
use App\Exports\StationStartTimeWithData;
use Maatwebsite\Excel\Excel as ExcelFormat;

class ReportController extends Controller
{
    public function index_station(): View
    {

        return view('reports.station_list_form', ["stations" => Station::all()]);
    }
    public function export_station_xlsx(Request $request)
    {
        $validatedData = $request->validate([
            'export_format' => 'required|string|in:xlsx,csv,pdf',
        ]);
        $results = DB::select(
            "SELECT s.name,
                ROUND(AVG(m.Measurement_Value), 2) AS avg_value,
                ROUND(MAX(m.Measurement_Value), 2) AS max_value,
                ROUND(MIN(m.Measurement_Value), 2) AS min_value,
                MIN(m.Measurement_Time) AS start_working_at
            FROM Measurment m
            JOIN Station s ON m.ID_Station = s.ID_Station
                 GROUP BY s.name;"
        );
        $export_data = new StationStartTimeWithData(
            $results
        );
        return match ($validatedData['export_format']) {
            'xlsx' => Excel::download($export_data, 'StationStartTimeWithData.xlsx'),

            'csv' => Excel::download($export_data, 'StationStartTimeWithData.csv', ExcelFormat::CSV, [
                'Content-Type' => 'text/csv',
            ]),

            'pdf' => Excel::download($export_data, 'StationStartTimeWithData.pdf', ExcelFormat::MPDF),

            default => abort(400, 'Invalid export format'), // Handle unexpected formats
        };
    }
    public function export_station_csv()
    {
        return Excel::download(new DataExport, 'stations.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }
    public function export_station_mpdf()
    {
        return Excel::download(new DataExport, 'stations.pdf', \Maatwebsite\Excel\Excel::TCPDF);
    }
    public function results_from_station_by_tyme(Request $request)
    {
        $validatedData = $request->validate([
            'id_station' => 'required|string|exists:station,id_station',
            'start_time' => 'required|date|before_or_equal:end_time',
            'end_time' => 'required|date|after_or_equal:start_time',
            'export_format' => 'required|in:xlsx,csv,pdf',
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
        $export_data = new StationMeasurementExport($results);
        return match ($validatedData['export_format']) {
            'xlsx' => Excel::download($export_data, 'station_measurements.xlsx'),

            'csv' => Excel::download($export_data, 'station_measurements.csv', ExcelFormat::CSV, [
                'Content-Type' => 'text/csv',
            ]),

            'pdf' => Excel::download($export_data, 'station_measurements.pdf', ExcelFormat::MPDF, [
                'orientation' => 'L',

            ]),

            default => abort(400, 'Invalid export format'), // Handle unexpected formats
        };
        return;
    }

}
