<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StationMeasurementExport implements FromArray, WithHeadings, WithStyles
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
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:E1')->getFont()->setBold(true); // Bold headings
        $sheet->getDefaultRowDimension()->setRowHeight(20);  // Increase row height
        $sheet->getColumnDimension('A')->setWidth(40);       // Adjust column widths
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(10);
        $sheet->getColumnDimension('D')->setWidth(10);
        $sheet->getColumnDimension('E')->setWidth(10);
        $sheet->getStyle('C')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('D')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('E')->getAlignment()->setHorizontal('center');
    }
}
