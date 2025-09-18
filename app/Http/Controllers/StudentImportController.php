<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;

class StudentImportController extends Controller
{
    public function showImportForm()
    {
        return view('admin.students.import');
    }

    public function import()
    {
        request()->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new StudentsImport, request()->file('file'));

        return redirect()->back()->with('success', 'Data siswa berhasil diimpor & QR Code telah dibuat.');
    }
}