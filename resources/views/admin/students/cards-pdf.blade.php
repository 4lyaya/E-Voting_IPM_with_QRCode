<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Kartu QR IPM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            background: #f2f2f2;
            padding: 10mm;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10mm;
        }

        .card {
            width: 130mm;
            /* ← DIPERBESAR dari 110mm menjadi 130mm */
            height: 70mm;
            border: 1px solid #000;
            border-radius: 12px;
            padding: 12px;
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            display: flex;
            flex-direction: row;
            /* ← pastikan horizontal */
            overflow: hidden;
        }

        .header {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 12px;
            color: #1e40af;
            border-bottom: 2px solid #1e40af;
            padding-bottom: 6px;
            width: 100%;
            grid-column: 1 / -1;
        }

        .content {
            display: flex;
            flex: 1;
            gap: 12px;
            align-items: flex-start;
            margin-top: 5px;
        }

        .info {
            flex: 1;
            /* Mengambil sisa ruang kiri */
            font-size: 13px;
            line-height: 1.7;
            color: #333;
            min-width: 0;
            /* Biarkan bisa menyempit */
        }

        .info-row {
            margin-bottom: 6px;
            display: flex;
            align-items: center;
        }

        .info-row i {
            width: 18px;
            color: #1e40af;
            margin-right: 6px;
            font-size: 14px;
        }

        .qr {
            width: 140px;
            /* ← Tetap besar */
            height: 140px;
            border: 2px solid #1e40af;
            border-radius: 8px;
            padding: 8px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            /* ← Jangan menyusut! */
            margin-left: 10px;
            margin-top: 5px;
            /* Pastikan tidak ikut menyempit */
        }

        .qr img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .footer {
            position: absolute;
            bottom: 8px;
            left: 12px;
            right: 12px;
            font-size: 10px;
            text-align: center;
            color: #666;
            border-top: 1px solid #e5e7eb;
            padding-top: 6px;
        }

        .label {
            font-weight: 600;
            color: #374151;
            min-width: 50px;
            display: inline-block;
        }

        /* PRINT STYLES: 3 CARDS PER PAGE */
        @media print {
            body {
                background: none;
                padding: 0;
                margin: 0;
            }

            .card {
                box-shadow: none;
                margin: 0;
                width: 130mm !important;
                /* ← Juga diperbesar di print */
                height: 70mm !important;
                page-break-inside: avoid;
                page-break-after: avoid;
                margin-bottom: 5mm;
            }

            /* Agar 3 kartu pas per halaman A4 (landscape) */
            body {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                padding: 5mm;
            }

            /* Setiap 3 kartu mulai baris baru */
            .card:nth-child(3n+1) {
                clear: left;
            }
        }
    </style>
</head>

<body>
    @foreach ($students as $student)
        <?php
        // buat QR on-the-fly
        $qrCode = new \Endroid\QrCode\QrCode($student->nis);
        $writer = new \Endroid\QrCode\Writer\PngWriter();
        $result = $writer->write($qrCode);
        $qrBase64 = base64_encode($result->getString());
        ?>
        <div class="card">
            <div class="header">
                <i class="fas fa-id-card"></i> KARTU E-VOTING IPM
            </div>

            <div class="content">
                <div class="info">
                    <div class="info-row">
                        <i class="fas fa-hashtag"></i>
                        <span><span class="label">NIS</span>: {{ $student->nis }}</span>
                    </div>
                    <div class="info-row">
                        <i class="fas fa-user"></i>
                        <span><span class="label">Nama</span>: {{ $student->name }}</span>
                    </div>
                    <div class="info-row">
                        <i class="fas fa-door-open"></i>
                        <span><span class="label">Kelas</span>: {{ $student->classroom }}</span>
                    </div>
                </div>

                <div class="qr">
                    <img src="data:image/png;base64,{{ $qrBase64 }}" alt="QR Code">
                </div>
            </div>

            <div class="footer">
                <i class="fas fa-info-circle mr-1"></i>
                Panitia Pemilu IPM 2025 - E-Voting IPM
            </div>
        </div>
    @endforeach
</body>

</html>
