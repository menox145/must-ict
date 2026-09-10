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
            background: linear-gradient(135deg, #4f46e5 0%, #2563eb 100%);
            border-radius: 1.2rem;
            color: white;
            padding: 2.5rem;
            box-shadow: 0 20px 25px -5px rgba(37, 99, 235, 0.3), 0 8px 10px -6px rgba(37, 99, 235, 0.3);
            margin-bottom: -3rem; /* Negative margin to overlap card */
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
            padding: 1.25rem;
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
            padding: 0.6rem 1.2rem;
            border: 1px solid #e5e7eb;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: all 0.2s;
            background-color: #f9fafb;
        }
        div.dataTables_wrapper div.dataTables_filter input:focus {
            outline: none;
            background-color: #ffffff;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
        .page-item.active .page-link {
            background-color: #4f46e5;
            border-color: #4f46e5;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.4);
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
        <div class="dashboard-header d-flex flex-wrap justify-content-between align-items-center animate__animated animate__fadeInDown">
            <div>
                <h2 class="mb-1 fw-bold"><i class="bi bi-clipboard-data me-2"></i> Manajemen Peminjaman</h2>
                <p class="text-white-50 mb-0" style="font-size: 1.1rem;">Lacak dan kelola sirkulasi inventaris dengan mudah.</p>
            </div>
            <a href="{{ route('pinjam.create') }}" class="btn btn-light btn-lg text-primary fw-bold shadow rounded-pill px-4" 
               style="transition: all 0.3s; transform: translateY(0);" 
               onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.2)';" 
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='';">
                <i class="bi bi-plus-lg me-1"></i> Buat Peminjaman
            </a>
        </div>

        <div class="custom-card animate__animated animate__fadeInUp animate__delay-1s">
            <div class="table-responsive">
                <table id="peminjamanTable" class="table table-custom w-100">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th>Peminjam</th>
                            <th>Barang</th>
                            <th class="text-center">Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($peminjaman->count() > 0)
                            @foreach ($peminjaman as $pinjam)
                                <tr>
                                    <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $pinjam->user->name }}</div>
                                        <div class="small text-muted"><i class="bi bi-person-badge"></i> {{ ucfirst($pinjam->user->unit_bagian) }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-primary">{{ $pinjam->barang->nama_barang }}</div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-soft-info rounded-pill fs-6 px-3">{{ $pinjam->jumlah_pinjam }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center text-secondary">
                                            <i class="bi bi-calendar2-event me-2 text-primary"></i>
                                            <span class="fw-medium">{{ date('d M Y', strtotime($pinjam->tanggal_pinjam)) }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center text-secondary">
                                            <i class="bi bi-calendar2-check me-2 text-success"></i>
                                            <span class="fw-medium">{{ date('d M Y', strtotime($pinjam->tanggal_kembali)) }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if ($pinjam->status == 'dipinjam')
                                            <span class="badge badge-soft-warning rounded-pill px-3 py-2 shadow-sm text-dark">
                                                <i class="bi bi-hourglass-split me-1"></i> Dipinjam
                                            </span>
                                        @elseif($pinjam->status == 'dikembalikan')
                                            <span class="badge badge-soft-success rounded-pill px-3 py-2 shadow-sm">
                                                <i class="bi bi-check-circle-fill me-1"></i> Dikembalikan
                                            </span>
                                        @else
                                            <span class="badge badge-soft-danger rounded-pill px-3 py-2 shadow-sm">
                                                <i class="bi bi-x-circle-fill me-1"></i> Dibatalkan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="/pinjam/{{ $pinjam->id }}" class="btn btn-action btn-outline-primary border-0" style="background-color: #eff6ff;" data-bs-toggle="tooltip" title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            @if (Auth::user()->is_admin)
                                                @if ($pinjam->status == 'dipinjam')
                                                    <form action="{{ route('pinjam.update-status', $pinjam->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="dikembalikan">
                                                        <button type="button" class="btn btn-action btn-outline-success border-0 btn-confirm-status" style="background-color: #ecfdf5;" data-title="Tandai Dikembalikan?" data-text="Barang ini akan ditandai sebagai sudah dikembalikan ke inventaris." data-bs-toggle="tooltip" title="Tandai Dikembalikan">
                                                            <i class="bi bi-check2-all fs-5"></i>
                                                        </button>
                                                    </form>
                                                @elseif ($pinjam->status == 'dikembalikan')
                                                    <form action="{{ route('pinjam.update-status', $pinjam->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="dipinjam">
                                                        <button type="button" class="btn btn-action btn-outline-warning border-0 btn-confirm-status" style="background-color: #fffbeb;" data-title="Batalkan Pengembalian?" data-text="Status barang ini akan diubah kembali menjadi sedang dipinjam." data-bs-toggle="tooltip" title="Set Menjadi Dipinjam">
                                                            <i class="bi bi-arrow-counterclockwise fs-5"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
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
            // Inisialisasi DataTable Premium
            $('#peminjamanTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
                    search: "_INPUT_",
                    searchPlaceholder: "🔍 Cari peminjam, barang..."
                },
                responsive: true,
                order: [[4, 'desc']], // Urutkan berdasarkan tanggal pinjam secara default
                columnDefs: [
                    { orderable: false, targets: [7] } // Nonaktifkan sorting pada kolom Aksi
                ],
                dom: '<"d-flex justify-content-between align-items-center mb-3"lf>rt<"d-flex justify-content-between align-items-center mt-4"ip>',
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

            // SweetAlert Confirmations for Status Update Buttons
            $('.btn-confirm-status').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var title = $(this).data('title');
                var text = $(this).data('text');
                
                Swal.fire({
                    title: title,
                    text: text,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#4f46e5',
                    cancelButtonColor: '#ef4444',
                    confirmButtonText: '<i class="bi bi-check-lg me-1"></i> Ya, Lanjutkan!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'rounded-4 shadow-lg border-0',
                        confirmButton: 'btn btn-primary rounded-pill px-4 mx-2',
                        cancelButton: 'btn btn-danger rounded-pill px-4 mx-2'
                    },
                    buttonsStyling: false,
                    backdrop: `rgba(0,0,50,0.1) backdrop-filter blur(3px)`
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Tampilkan loading sebelum submit
                        Swal.fire({
                            title: 'Memproses...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
