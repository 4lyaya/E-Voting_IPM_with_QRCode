<?php

namespace App\Imports;

use App\Models\Student;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Generate QR
        $qrCode = new QrCode($row['nis']);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Pastikan folder ada
        $folder = storage_path('app/public/qr_code');
        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }

        // Simpan file ke storage/app/public/qr_code/nis.png
        $fileName = $row['nis'] . '.png';
        $storagePath = 'qr_code/' . $fileName;       // untuk DB
        file_put_contents("$folder/$fileName", $result->getString());

        return new Student([
            'nis' => $row['nis'],
            'name' => $row['name'],
            'classroom' => $row['classroom'],
            'has_voted' => false,
            'qr_code_path' => $storagePath,   // qr_code/20250001.png
        ]);
    }
}