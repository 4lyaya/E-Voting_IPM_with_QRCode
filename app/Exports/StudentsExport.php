<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Student::select('nis', 'name', 'classroom')->get();
    }

    public function headings(): array
    {
        return [
            'NIS',
            'NAMA',
            'KELAS'
        ];
    }

    public function map($row): array
    {
        return [
            $row->nis,
            $row->name,
            $row->classroom,
        ];
    }
}