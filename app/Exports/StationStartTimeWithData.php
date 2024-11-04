<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StationStartTimeWithData implements FromArray, WithHeadings, WithStyles
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
            'Average Value',
            'Max Value',
            'Min Value',
            'Earliest Measurement Time',
        ];
    }

    protected function formatData($measurements)
    {
        $formattedData = [];

        foreach ($measurements as $measurement) {
            $formattedData[] = [
                $measurement->name,
                $measurement->avg_value,
                $measurement->max_value,
                $measurement->min_value,
                $measurement->start_working_at,
            ];
        }

        return $formattedData;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $sheet->getDefaultRowDimension()->setRowHeight(20);
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(15);

        $sheet->getStyle('B')->getAlignment()->setHorizontal('center');
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getStyle('C')->getAlignment()->setHorizontal('center');
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getStyle('D')->getAlignment()->setHorizontal('center');
        $sheet->getColumnDimension('E')->setWidth(30);
    }
}
