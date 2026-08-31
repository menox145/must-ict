<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Worksheet</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .header p {
            margin: 2px 0;
        }

        .filter-info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background-color: #333;
            color: white;
        }

        table th {
            padding: 10px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
        }

        table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .status-proses {
            background-color: #fff3cd;
            padding: 4px 8px;
            border-radius: 3px;
            font-weight: bold;
        }

        .status-selesai {
            background-color: #d4edda;
            padding: 4px 8px;
            border-radius: 3px;
            font-weight: bold;
            color: #155724;
        }

        .status-batal {
            background-color: #f8d7da;
            padding: 4px 8px;
            border-radius: 3px;
            font-weight: bold;
            color: #721c24;
        }

        .footer {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }

        .signature {
            text-align: center;
            width: 30%;
        }

        .signature p {
            margin-top: 60px;
            border-top: 1px solid #333;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none;
            }
        }

        .print-btn {
            margin-bottom: 20px;
        }

        .print-btn button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .print-btn button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="print-btn no-print">
        <button onclick="window.print()">Cetak</button>
        <button onclick="window.history.back()">Kembali</button>
    </div>

    <div class="container">
        <div class="header">
            <h1>LAPORAN WORKSHEET - PEKERJAAN HARIAN</h1>
            <p>Tanggal Cetak: {{ date('d/m/Y H:i') }}</p>
        </div>

        @if ($tanggal_dari || $tanggal_sampai || $status_filter)
            <div class="filter-info">
                <strong>Filter:</strong>
                @if ($tanggal_dari)
                    Dari {{ date('d/m/Y', strtotime($tanggal_dari)) }}
                @endif
                @if ($tanggal_sampai)
                    sampai {{ date('d/m/Y', strtotime($tanggal_sampai)) }}
                @endif
                @if ($status_filter)
                    | Status: {{ $status_filter }}
                @endif
            </div>
        @endif

        @if ($worksheets->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 10%;">Tanggal</th>
                        <th style="width: 15%;">Jenis Pekerjaan</th>
                        <th style="width: 35%;">Keterangan</th>
                        <th style="width: 15%;">Perkiraan</th>
                        <th style="width: 10%;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($worksheets as $worksheet)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $worksheet->tanggal->format('d/m/Y') }}</td>
                            <td>{{ $worksheet->jenis_pekerjaan }}</td>
                            <td>{{ $worksheet->keterangan_pekerjaan }}</td>
                            <td>{{ $worksheet->perkiraan_pekerjaan }}</td>
                            <td>
                                @if ($worksheet->status === 'Proses')
                                    <span class="status-proses">{{ $worksheet->status }}</span>
                                @elseif($worksheet->status === 'Selesai')
                                    <span class="status-selesai">{{ $worksheet->status }}</span>
                                @else
                                    <span class="status-batal">{{ $worksheet->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top: 40px; text-align: right;">
                <p>Total Data: <strong>{{ $worksheets->count() }}</strong></p>
            </div>
        @else
            <div style="text-align: center; padding: 40px; background-color: #f9f9f9; border-radius: 4px;">
                <p>Tidak ada data worksheet untuk ditampilkan</p>
            </div>
        @endif

        <div class="footer">
            <div class="signature">
                <p>Mengetahui</p>
                <p>Kepala Bagian</p>
            </div>
            <div class="signature">
                <p>Dibuat Oleh</p>
                <p>{{ auth()->user()->name }}</p>
            </div>
        </div>
    </div>
</body>

</html>
