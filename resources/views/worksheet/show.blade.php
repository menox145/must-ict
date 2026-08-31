@extends('layouts.main')

@section('container')
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Detail Worksheet</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Tanggal</h6>
                                <p class="lead">{{ $worksheet->tanggal->format('d/m/Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Status</h6>
                                <p>
                                    <span
                                        class="badge 
                                    @if ($worksheet->status === 'Proses') bg-warning
                                    @elseif($worksheet->status === 'Selesai') bg-success
                                    @else bg-danger @endif
                                ">
                                        {{ $worksheet->status }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <h6 class="text-muted">Jenis Pekerjaan</h6>
                            <p class="lead">{{ $worksheet->jenis_pekerjaan }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted">Keterangan Pekerjaan</h6>
                            <p>{{ nl2br($worksheet->keterangan_pekerjaan) }}</p>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Perkiraan Pekerjaan</h6>
                                <p class="lead">{{ $worksheet->perkiraan_pekerjaan }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Dibuat Pada</h6>
                                <p>{{ $worksheet->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('worksheet.edit', $worksheet) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a href="{{ route('worksheet.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
