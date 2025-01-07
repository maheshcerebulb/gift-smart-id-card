<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\LiqourApplication; // Assuming LiqourApplication is your model
use Maatwebsite\Excel\Concerns\WithHeadings;


class ExportLiqourApp implements FromCollection, WithHeadings
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }
    public function headings(): array
    {
        return [
            'Application Number',
            'Serial Number',
            'Name',
            'Company Name',
            'Designation',
            'Mobile Number',
            'Scan Count',
            'Issue Date',
            'Expiry Date',
            'status',
        ];
    }
}