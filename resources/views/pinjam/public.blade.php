@extends('layouts.main')

@section('container')
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Animate.css for micro-animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        
        /* Premium Header Gradient */
        .dashboard-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 1.2rem;
            color: white;
            padding: 2.5rem;
            box-shadow: 0 20px 25px -5px rgba(16, 185, 129, 0.3), 0 8px 10px -6px rgba(16, 185, 129, 0.3);
            margin-bottom: -3rem; 
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .dashboard-header::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
        }

        /* Card Container */
        .custom-card {
            border: none;
            border-radius: 1.2rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 2;
            margin-top: 2rem;
            padding: 2rem;
            height: 100%;
        }

        /* Form Controls Premium */
        .form-control, .form-select {
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
            transition: all 0.2s;
        }
        .form-control:focus, .form-select:focus {
            background-color: #ffffff;
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
        }
        
        /* Modern Spaced Table */
        .table-custom {
            border-collapse: separate;
            border-spacing: 0 0.75rem;
        }
        .table-custom thead th {
            border: none;
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            color: #6b7280;
            padding: 1rem 1.25rem;
            background-color: transparent;
        }
        .table-custom tbody tr {
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 0.75rem;
        }
        .table-custom tbody tr:hover {
            transform: translateY(-3px) scale(1.005);
            box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.08);
            z-index: 10;
            position: relative;
        }
        .table-custom tbody td {
            border-top: 1px solid #f9fafb;
            border-bottom: 1px solid #f9fafb;
            padding: 1rem 1.25rem;
            vertical-align: middle;
            color: #374151;
        }
        .table-custom tbody td:first-child {
            border-left: 1px solid #f9fafb;
            border-top-left-radius: 0.75rem;
            border-bottom-left-radius: 0.75rem;
        }
        .table-custom tbody td:last-child {
            border-right: 1px solid #f9fafb;
            border-top-right-radius: 0.75rem;
            border-bottom-right-radius: 0.75rem;
        }
        
        /* Soft Badges */
        .badge-soft-warning { background-color: #fffbeb; color: #d97706; border: 1px solid #fde68a; }
        .badge-soft-success { background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; }
        .badge-soft-danger { background-color: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
        .badge-soft-info { background-color: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
        
        /* Circular Action Buttons */
        .btn-action {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-action:hover {
            transform: translateY(-2px) scale(1.1);
        }

        /* DataTables Premium Customization */
        div.dataTables_wrapper div.dataTables_filter {
            margin-bottom: 1.5rem;
        }
        div.dataTables_wrapper div.dataTables_filter input {
            border-radius: 20px;
            padding: 0.5rem 1rem;
            border: 1px solid #e5e7eb;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: all 0.2s;
            background-color: #f9fafb;
        }
        div.dataTables_wrapper div.dataTables_filter input:focus {
            outline: none;
            background-color: #ffffff;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }
        .page-item.active .page-link {
            background-color: #10b981;
            border-color: #10b981;
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.4);
            border-radius: 8px;
        }
        .page-item .page-link {
            border-radius: 8px;
            margin: 0 3px;
            color: #4b5563;
            border: none;
        }
    </style>

    <div class="container mt-4 mb-5">
        <!-- Premium Dashboard Header -->
        <div class="dashboard-header animate__animated animate__fadeInDown">
            <h2 class="mb-1 fw-bold"><i class="bi bi-box-arrow-in-right me-2"></i> Layanan Peminjaman Barang ICT</h2>
            <p class="text-white-50 mb-0" style="font-size: 1.1rem;">Isi form di bawah ini untuk mengajukan peminjaman barang ICT.</p>
        </div>

        <div class="row align-items-stretch animate__animated animate__fadeInUp animate__delay-1s">
            <!-- Form Section -->
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="custom-card">
                    <h5 class="fw-bold text-success mb-4"><i class="bi bi-ui-checks me-2"></i> Form Pengajuan</h5>
                    <form action="{{ route('pinjam.store') }}" method="POST" id="formPinjam">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold text-secondary">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Masukkan nama Anda">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="unit_bagian" class="form-label fw-semibold text-secondary">Unit / Bagian</label>
                            <select class="form-select @error('unit_bagian') is-invalid @enderror" id="unit_bagian" name="unit_bagian" required>
                                <option value="">Pilih Unit...</option>
                                <option value="ranap" {{ old('unit_bagian') == 'ranap' ? 'selected' : '' }}>Rawat Inap</option>
                                <option value="keuangan" {{ old('unit_bagian') == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                                <option value="rajal" {{ old('unit_bagian') == 'rajal' ? 'selected' : '' }}>Rawat Jalan</option>
                                <option value="adm" {{ old('unit_bagian') == 'adm' ? 'selected' : '' }}>Adm Medis</option>
                                <option value="igd" {{ old('unit_bagian') == 'igd' ? 'selected' : '' }}>IGD</option>
                                <option value="icu" {{ old('unit_bagian') == 'icu' ? 'selected' : '' }}>ICU</option>
                                <option value="Kedokteran" {{ old('unit_bagian') == 'Kedokteran' ? 'selected' : '' }}>Kedokteran</option>
                            </select>
                            @error('unit_bagian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="barang_id" class="form-label fw-semibold text-secondary">Pilih Barang</label>
                            <select class="form-select @error('barang_id') is-invalid @enderror" id="barang_id" name="barang_id" required>
                                <option value="">Pilih Barang...</option>
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}" {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                        {{ $barang->nama_barang }} (Stok: {{ $barang->stok }})
                                    </option>
                                @endforeach
                            </select>
                            @error('barang_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_pinjam" class="form-label fw-semibold text-secondary">Jumlah Pinjam</label>
                            <input type="number" class="form-control @error('jumlah_pinjam') is-invalid @enderror"
                                id="jumlah_pinjam" name="jumlah_pinjam" value="{{ old('jumlah_pinjam', 1) }}" min="1" required>
                            @error('jumlah_pinjam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="tanggal_pinjam" class="form-label fw-semibold text-secondary">Tgl Pinjam</label>
                                <input type="date" class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                                    id="tanggal_pinjam" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required>
                                @error('tanggal_pinjam')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6 mb-3">
                                <label for="tanggal_kembali" class="form-label fw-semibold text-secondary">Tgl Kembali</label>
                                <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror"
                                    id="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" required>
                                @error('tanggal_kembali')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="keperluan" class="form-label fw-semibold text-secondary">Keperluan</label>
                            <textarea class="form-control @error('keperluan') is-invalid @enderror" id="keperluan" name="keperluan" rows="2"
                                required placeholder="Tujuan meminjam barang">{{ old('keperluan') }}</textarea>
                            @error('keperluan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success w-100 rounded-pill fw-bold py-2 shadow-sm" style="transition: all 0.3s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                            <i class="bi bi-send-check me-2"></i> Ajukan Peminjaman
                        </button>
                    </form>
                </div>
            </div>

            <!-- Table Section -->
            <div class="col-lg-8">
                <div class="custom-card p-4">
                    <h5 class="fw-bold text-success mb-4"><i class="bi bi-card-list me-2"></i> Daftar Riwayat Peminjaman Umum</h5>
                    <div class="table-responsive">
                        <table id="peminjamanTable" class="table table-custom w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Peminjam</th>
                                    <th>Barang</th>
                                    <th>Tgl Pinjam</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($peminjaman->count() > 0)
                                    @foreach ($peminjaman as $pinjam)
                                        <tr>
                                            <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="fw-bold text-dark">{{ $pinjam->user->name }}</div>
                                                <div class="small text-muted">{{ ucfirst($pinjam->user->unit_bagian) }}</div>
                                            </td>
                                            <td>
                                                <div class="fw-bold text-success">{{ $pinjam->barang->nama_barang }}</div>
                                                <div class="small text-muted">{{ $pinjam->jumlah_pinjam }} unit</div>
                                            </td>
                                            <td>
                                                <div class="text-secondary fw-medium">{{ date('d M Y', strtotime($pinjam->tanggal_pinjam)) }}</div>
                                            </td>
                                            <td class="text-center">
                                                @if ($pinjam->status == 'dipinjam')
                                                    <span class="badge badge-soft-warning rounded-pill px-3 py-1 shadow-sm text-dark">
                                                        <i class="bi bi-hourglass-split me-1"></i> Dipinjam
                                                    </span>
                                                @elseif ($pinjam->status == 'dikembalikan')
                                                    <span class="badge badge-soft-success rounded-pill px-3 py-1 shadow-sm">
                                                        <i class="bi bi-check-circle-fill me-1"></i> Dikembalikan
                                                    </span>
                                                @else
                                                    <span class="badge badge-soft-danger rounded-pill px-3 py-1 shadow-sm">
                                                        <i class="bi bi-x-circle-fill me-1"></i> Dibatalkan
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="/pinjam/{{ $pinjam->id }}" class="btn btn-action btn-outline-success border-0" style="background-color: #ecfdf5;" data-bs-toggle="tooltip" title="Lihat Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Datatables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    
    <!-- Datatables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- SweetAlert2 for Premium Popups -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Form Validation and Loading state
            $('#formPinjam').on('submit', function() {
                Swal.fire({
                    title: 'Memproses Pengajuan...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            });

            // Date validation logic
            const today = new Date().toISOString().split('T')[0];
            const tanggalPinjam = document.getElementById('tanggal_pinjam');
            const tanggalKembali = document.getElementById('tanggal_kembali');

            tanggalPinjam.min = today;
            tanggalKembali.min = today;

            tanggalPinjam.addEventListener('change', function() {
                tanggalKembali.min = this.value;
                if (tanggalKembali.value && tanggalKembali.value < this.value) {
                    tanggalKembali.value = this.value;
                }
            });

            // Inisialisasi DataTable Premium
            $('#peminjamanTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
                    search: "_INPUT_",
                    searchPlaceholder: "🔍 Cari peminjam..."
                },
                responsive: true,
                order: [[3, 'desc']], // Urutkan berdasarkan tanggal pinjam (kolom ke 4)
                columnDefs: [
                    { orderable: false, targets: [4, 5] } 
                ],
                dom: '<"d-flex justify-content-between align-items-center mb-3"lf>rt<"d-flex justify-content-between align-items-center mt-4"ip>',
                pageLength: 5,
                lengthMenu: [5, 10, 25]
            });

            // Inisialisasi Tooltip
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // SweetAlert Toast Notifications for Success/Error
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            @if(session('success'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ session("success") }}'
                });
            @endif

            @if(session('error'))
                Toast.fire({
                    icon: 'error',
                    title: '{{ session("error") }}'
                });
            @endif
        });
    </script>
@endsection
