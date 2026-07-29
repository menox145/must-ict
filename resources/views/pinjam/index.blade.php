@extends('layouts.main')

@section('container')
    <div class="container mt-4">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Daftar Peminjaman</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peminjam</th>
                                        <th>Unit/Bagian</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($peminjaman->count() > 0)
                                        @foreach ($peminjaman as $pinjam)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pinjam->user->name }}</td>
                                                <td>{{ ucfirst($pinjam->user->unit_bagian) }}</td>
                                                <td>{{ $pinjam->barang->nama_barang }}</td>
                                                <td>{{ $pinjam->jumlah_pinjam }}</td>
                                                <td>{{ date('d/m/Y', strtotime($pinjam->tanggal_pinjam)) }}</td>
                                                <td>{{ date('d/m/Y', strtotime($pinjam->tanggal_kembali)) }}</td>
                                                <td>
                                                    @if ($pinjam->status == 'dipinjam')
                                                        <span class="badge bg-warning">Dipinjam</span>
                                                    @elseif($pinjam->status == 'dikembalikan')
                                                        <span class="badge bg-success">Dikembalikan</span>
                                                    @else
                                                        <span class="badge bg-danger">Dibatalkan</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="/pinjam/{{ $pinjam->id }}"
                                                        class="badge bg-info text-decoration-none">
                                                        <i class="bi bi-eye"></i> Detail
                                                    </a>

                                                    @if (Auth::user()->is_admin)
                                                        @if ($pinjam->status == 'dipinjam')
                                                            <form action="{{ route('pinjam.update-status', $pinjam->id) }}" method="POST"
                                                                class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status" value="dikembalikan">
                                                                <button type="submit" class="badge bg-success border-0"
                                                                    onclick="return confirm('Ubah status menjadi dikembalikan?')">
                                                                    <i class="bi bi-check-circle"></i> Dikembalikan
                                                                </button>
                                                            </form>
                                                        @elseif ($pinjam->status == 'dikembalikan')
                                                            <form action="{{ route('pinjam.update-status', $pinjam->id) }}" method="POST"
                                                                class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status" value="dipinjam">
                                                                <button type="submit" class="badge bg-warning border-0"
                                                                    onclick="return confirm('Ubah status menjadi dipinjam?')">
                                                                    <i class="bi bi-arrow-counterclockwise"></i> Dipinjam
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="text-center">Tidak ada data peminjaman</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
