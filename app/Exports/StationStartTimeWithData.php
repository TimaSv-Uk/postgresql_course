<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StationStartTimeWithData implements FromArray,  WithStyles,WithHeadings
{
    protected $data;

    public function __construct($measurements)
    {
        $this->data = $this->formatData($measurements);
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Station Name',
            'Earliest Measurement Time',
            'Mesured units'
        ];
    }
    protected function formatData($measurements)
    {
        $formattedData = [];

        foreach ($measurements as $measurement) {
            $formattedData[] = [
                $measurement->name,
                $measurement->start_working_at,
                $measurement->titles,
            ];
        }

        return $formattedData;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);

        $sheet->getDefaultRowDimension()->setRowHeight(20);
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(30);

        $sheet->getStyle('B')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('C')->getAlignment()->setHorizontal('center');
    }
}
