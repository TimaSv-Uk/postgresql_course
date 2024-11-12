<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MeasuredUnit;
use App\Models\Measurment;
use App\Models\OptimalValue;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataVisualization extends Controller
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
        $measurements = Measurment::where("id_station", "=", $station_id)
            ->where("id_measured_unit", "=", $PS25ID)
            ->get();

        //poor categoty starts with id 4
        $poor_value_ranges = OptimalValue::where("id_measured_unit", "=", $PS25ID)->where("id_category", ">=", "4")->get();
        $poor_value_counts = $this->value_counts($measurements, $poor_value_ranges);
        /*dd($measurements->take(10),$poor_value_counts);*/
        /*$specificDate = '2022-05-09'; // Example date*/
        /*$measurements = Measurment::where("id_station", "=", $station_id)*/
        /*    ->where("id_measured_unit", "=", $PS25ID)*/
        /*    ->whereDate('measurement_time', $specificDate)*/
        /*    ->avg();*/
        /**/

        return view('data_visualization.v2', ['stations' => Station::all(), "poor_value_counts" => $poor_value_counts, "selected_station" => Station::find($station_id)]);
    }
    public function visualization3(Request $request)
    {
        $station_id = $request["station"];
        if ($station_id === null) {
            return view('data_visualization.v3', ['stations' => Station::all()]);
        }

        /*NOTE: Sulfur dioxide id = 15 and there is no optimal values in OptimalValue table from 15*/
        /*Air Quolity Index id = 9*/
        $id_measured_unit = 9;

        $measurements = Measurment::where("id_station", "=", $station_id)
            ->where("id_measured_unit", "=", $id_measured_unit)
            ->get();
        //NOTE: poor categoty starts with id 4
        $optimal_value_ranges = OptimalValue::where("id_measured_unit", "=", $id_measured_unit)->where("id_category", "<", "4")->get();

        $optimal_value_counts = $this->value_counts($measurements, $optimal_value_ranges);
        return view('data_visualization.v3', ['stations' => Station::all(), "optimal_value_counts" => $optimal_value_counts, "selected_station" => Station::find($station_id)]);
    }

    public function visualization4(Request $request)
    {
        $station_id = $request["station"];
        if ($station_id === null) {
            return view('data_visualization.v4', ['stations' => Station::all()]);
        }
        $id_measured_unit = 9;
        $optimal_value_ranges = OptimalValue::where("id_measured_unit", "=", $id_measured_unit)
            /*->where("id_category", "<", "4")*/
            ->get();
        $measurements = Measurment::where("id_station", "=", $station_id)
            ->where("id_measured_unit", "=", $id_measured_unit)
            ->selectRaw("DATE(measurement_time) as date, AVG(measurement_value) as measurement_value")
            ->groupBy("date")
            ->orderBy("date", "asc")
            ->get();

        $optimal_value_counts = $this->value_counts($measurements, $optimal_value_ranges);
        return view('data_visualization.v4', ['stations' => Station::all(), "optimal_value_counts" => $optimal_value_counts, "selected_station" => Station::find($station_id)]);
    }
    private function value_counts($measurements, $optimal_value_ranges)
    {
        $optimal_value_counts = [];
        foreach ($optimal_value_ranges as $optimal_value_range) {
            $category = Category::find($optimal_value_range->id_category);

            $range = $this->parse_pg_range($optimal_value_range->optimal_range);
            $lowerBound = $range["lower"];
            $upperBound = $range["upper"];

            $count_measurement = $measurements
                ->whereBetween("measurement_value", [$lowerBound, $upperBound])
                ->count();
            $optimal_value_counts[] = [
                0 => $category,
                1 => $count_measurement,
            ];
        }
        return $optimal_value_counts;
    }
    private function parse_pg_range($range)
    {
        $lower_inclusive = $range[0] == '[';
        $upper_inclusive = $range[-1] == ']';

        $range = trim($range, '[]()');

        [$lower, $upper] = explode(',', $range);
        if (!$lower_inclusive) {
            $lower--;
        }
        if (!$upper_inclusive) {
            $upper--;
        }
        return [
            'lower' => $lower,
            'upper' => $upper,
        ];
    }
}
