<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 12px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-start mb-3 no-print">
            <h4 class="mb-0">Print Data Barang</h4>
            <button type="button" class="btn btn-dark" onclick="window.print()">Print</button>
        </div>

        <div class="text-center mb-3">
            <h4 class="mb-1">DATA BARANG</h4>
            <p class="mb-0">ICT RSPJ</p>
        </div>

        <div class="mb-3">
            <strong>Filter:</strong>
            Search: {{ $filters['search'] ?? '-' }},
            Kondisi: {{ $filters['kondisi'] ?? '-' }},
            Lokasi: {{ $filters['lokasi'] ?? '-' }}
        </div>

        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Merk</th>
                    <th>Type</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Kondisi</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($barangs as $barang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $barang->kode_barang }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->merk }}</td>
                        <td>{{ $barang->type }}</td>
                        <td>{{ $barang->stok }}</td>
                        <td>{{ $barang->satuan }}</td>
                        <td>{{ $barang->kondisi }}</td>
                        <td>{{ $barang->lokasi }}</td>
                        <td>{{ $barang->keterangan ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Data barang tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        window.addEventListener('load', function() {
            window.print();
        });
    </script>
</body>

</html>
