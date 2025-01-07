<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\LiqourApplication; // Assuming LiqourApplication is your model
use Maatwebsite\Excel\Concerns\WithHeadings;


class ExportBuidlingCompanyApp implements FromCollection, WithHeadings
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
            'Employee Name',
            'DOB',
            'Gender',
            'Serial Number',
            'Company Unit',
            'Application Type',
            'issue_date',
            'expire_date',
            'Building',
            'Company Name',
            
        ];
        // return [
        //     'Serial Number',
        //     'Building',
        //     'Company Name',
        //     'Employee Name',
        //     'Application Type',
        //     'issue_date',
        //     'expire_date',
        //     'status',
        // ];
    }
}