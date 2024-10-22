<?php

namespace App\Exports;

use App\Models\Station;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Station::all();
    }
}
