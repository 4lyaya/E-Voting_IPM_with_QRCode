<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Hasil Perolehan Suara</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 20mm;
            background-color: #f9fafb;
            color: #374151;
            line-height: 1.6;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #1e40af;
            font-weight: 700;
            font-size: 24px;
            letter-spacing: -0.5px;
            position: relative;
            padding-bottom: 10px;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: #1e40af;
            border-radius: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background: linear-gradient(135deg, #1e40af, #1e3a8a);
            color: white;
            font-weight: 600;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px;
            text-align: center;
        }

        td {
            padding: 12px;
            text-align: center;
            font-size: 14px;
            border-bottom: 1px solid #e5e7eb;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #f0f7ff;
            transition: background-color 0.2s ease;
        }

        .progress-container {
            width: 100%;
            height: 8px;
            background-color: #e0e0e0;
            border-radius: 4px;
            overflow: hidden;
            margin: 6px auto;
            max-width: 150px;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #1e40af, #3b82f6);
            border-radius: 4px;
        }

        .total {
            margin-top: 35px;
            text-align: center;
            padding: 18px;
            background-color: #dbeafe;
            border: 1px dashed #bfdbfe;
            border-radius: 10px;
            font-weight: 700;
            font-size: 18px;
            color: #1e40af;
            letter-spacing: -0.3px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .total i {
            margin-right: 8px;
            color: #1e40af;
        }

        @media print {
            body {
                margin: 10mm;
                background: white;
                color: black;
            }

            h2 {
                color: #000;
                border-bottom-color: #000;
            }

            th {
                background: #e0e0e0 !important;
                color: #000 !important;
            }

            tr:nth-child(even) {
                background: white !important;
            }

            .total {
                background: #fff !important;
                border: 1px solid #ccc !important;
                box-shadow: none !important;
            }

            table {
                box-shadow: none;
            }
        }
    </style>
</head>

<body>
    <h2><i class="fas fa-chart-bar"></i> REKAPITULASI HASIL VOTE E-VOTING IPM</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kandidat</th>
                <th>Jumlah Suara</th>
                <th>Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="text-align: left; font-weight: 500;">{{ $item->name }}</td>
                    <td>{{ $item->votes_count }}</td>
                    <td>
                        {{ $totalVotes ? round(($item->votes_count / $totalVotes) * 100, 2) : 0 }}%
                        <div class="progress-container">
                            <div class="progress-bar"
                                style="width: {{ $totalVotes ? ($item->votes_count / $totalVotes) * 100 : 0 }}%;">
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <i class="fas fa-tally"></i> Total Suara Masuk: {{ $totalVotes }}
    </div>
</body>

</html>
