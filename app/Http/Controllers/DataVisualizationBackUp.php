<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MeasuredUnit;
use App\Models\Measurment;
use App\Models\OptimalValue;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataVisualizationBackUp extends Controller
{
    public function index()
    {
        return view("data_visualization.index", ['stations' => Station::all()]);
    }

    public function visualization1(Request $request)
    {

        $validatedData = $request->validate([
            'start_time' => 'required|date|before_or_equal:end_time',
            'end_time' => 'required|date|after_or_equal:start_time',
        ]);

        $start_time = \Carbon\Carbon::parse($validatedData['start_time'])->format('Y-m-d H:i:s');
        $end_time = \Carbon\Carbon::parse($validatedData['end_time'])->format('Y-m-d H:i:s');
        $station_max = DB::select(
            "SELECT s.name,
                MAX(m.Measurement_Value) AS max_value
            FROM Measurment m
            JOIN Station s ON m.ID_Station = s.ID_Station
            JOIN Measured_Unit mu ON mu.ID_Measured_Unit = m.ID_Measured_Unit
            WHERE (mu.title = 'PM2.5' OR mu.title = 'PM10')
            AND m.Measurement_Time BETWEEN ? AND ?
            GROUP BY s.name",
            [$start_time, $end_time]
        );
        return view("data_visualization.v1", ["station_max" => $station_max, "start_time" => $start_time, "end_time" => $end_time]);
    }

    public function visualization2(Request $request)
    {
        $station_id = $request["station"];
        if ($station_id === null) {
            return view('data_visualization.v2', ['stations' => Station::all()]);
        }

        $PS25ID = 3;
        $dailyAverages = Measurment::where("id_station", "=", $station_id)
            ->where("id_measured_unit", "=", $PS25ID)
            ->selectRaw('DATE(measurement_time) as measurement_date, AVG(measurement_value) as average_value')
            ->groupBy('measurement_date')
            ->orderBy('measurement_date')
            ->get();
        /*dd($dailyAverages);*/
        // Poor category starts with ID 4
        $poor_value_ranges = OptimalValue::where("id_measured_unit", "=", $PS25ID)->where("id_category", ">=", "4")->get();
        $poor_value_counts = [];
        foreach ($poor_value_ranges as $poor_value_range) {
            $category = Category::find($poor_value_range->id_category);

            $range = $this->parse_pg_range($poor_value_range->optimal_range);
            $lowerBound = $range["lower"];
            $upperBound = $range["upper"];
            $lowerInclusive = $range["lower_inclusive"];
            $upperInclusive = $range["upper_inclusive"];

            $count_measurement = $dailyAverages->filter(function ($measurement) use ($lowerBound, $upperBound, $lowerInclusive, $upperInclusive) {
                $lowerCondition = $lowerBound === null || ($lowerInclusive ? $measurement->average_value >= $lowerBound : $measurement->average_value > $lowerBound);
                $upperCondition = $upperBound === null || ($upperInclusive ? $measurement->average_value <= $upperBound : $measurement->average_value < $upperBound);

                return $lowerCondition && $upperCondition;
            })->count();

            $poor_value_count = [$category, $count_measurement];
            $poor_value_counts[] = $poor_value_count;
        }

        $specificDate = '2022-05-30'; // Example date
        $measurements = Measurment::where("id_station", "=", $station_id)
            ->where("id_measured_unit", "=", $PS25ID)
            ->whereDate('measurement_time', $specificDate)
            ->avg('measurement_value');
        dd($measurements);

        dd($poor_value_counts, $dailyAverages);
        return view('data_visualization.v2', ['stations' => Station::all(), "poor_value_counts" => $poor_value_counts, "selected_station" => Station::find($station_id)]);
    }
    private function parse_pg_range($range)
    {
        // Determine if the range is inclusive or exclusive
        $lower_inclusive = $range[0] == '[';
        $upper_inclusive = $range[-1] == ']';

        // Remove the square brackets or parentheses
        $range = trim($range, '[]()');

        // Split the range into lower and upper bounds
        [$lower, $upper] = explode(',', $range);

        return [
            'lower' => $lower === '' ? null : (float) $lower,
            'lower_inclusive' => $lower_inclusive,
            'upper' => $upper === '' ? null : (float) $upper,
            'upper_inclusive' => $upper_inclusive
        ];
    }
    public function visualization3()
    {
        return view("data_visualization.v3");
    }

    public function visualization4()
    {
        return view("data_visualization.v4");
    }
}
