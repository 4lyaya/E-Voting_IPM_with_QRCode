<?php

namespace App\Listeners;

use App\Events\StudentCreated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class GenerateStudentQrCode
{
    /**
     * Handle the event.
     */
    public function handle(StudentCreated $event): void
    {
        try {
            Log::info('Listener GenerateStudentQrCode dipanggil untuk NIS: ' . $event->student->nis);

            $student = $event->student;

            // generate qr
            $qrCode = new QrCode($student->nis);
            $writer = new PngWriter();
            $result = $writer->write($qrCode);

            // simpan ke storage/app/public/qr_codes
            $filename = 'qr_codes/' . $student->nis . '.png';
            Storage::disk('public')->put($filename, $result->getString());

            // update field qr_code_path
            $student->update(['qr_code_path' => $filename]);

            $updated = $student->update(['qr_code_path' => $filename]);
            Log::info('Update qr_code_path untuk NIS ' . $student->nis .
                ' -> ' . $filename . ' | result=' . ($updated ? 'true' : 'false'));

        } catch (\Throwable $e) {
            Log::error('Gagal buat QR: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }
}
