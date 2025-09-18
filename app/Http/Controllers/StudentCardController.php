<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Mpdf\Mpdf;

class StudentCardController extends Controller
{
    public function exportCards()
    {
        $students = Student::orderBy('classroom')->orderBy('name')->get();

        // tambahkan properti sementara: qr_base64
        foreach ($students as $s) {
            $qrCode = new QrCode($s->nis);
            $writer = new PngWriter();
            $result = $writer->write($qrCode);
            $s->qr_base64 = base64_encode($result->getString());
        }

        $html = view('admin.students.cards-pdf', compact('students'))->render();

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'autoPageBreak' => true,
        ]);

        $mpdf->WriteHTML($html);

        return response()->streamDownload(
            fn() => $mpdf->Output('kartu-qr-ipm.pdf', 'D'),
            'kartu-qr-ipm.pdf'
        );
    }
}