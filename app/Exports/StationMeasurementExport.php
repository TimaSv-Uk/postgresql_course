<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StationMeasurementExport implements FromArray,WithHeadings
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }
    public function headings(): array
    {
        return [
            'Station Name',
            'Measured Unit',
            'Average Value',
            'Maximum Value',
            'Minimum Value',
        ];
    }
}
