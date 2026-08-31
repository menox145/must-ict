@extends('layouts.main')

@section('container')
    <div class="container-fluid mt-5">
        <div class="row mb-4">
            <div class="col-md-12">
                <h1 class="mb-4">Worksheet - Pekerjaan Harian</h1>

                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addWorksheetModal">
                                    <i class="bi bi-plus"></i> Tambah Worksheet
                                </button>
                                <button class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#filterForm">
                                    <i class="bi bi-filter"></i> Filter
                                </button>
                                <a href="{{ route('worksheet.print', ['tanggal_dari' => $tanggal_dari, 'tanggal_sampai' => $tanggal_sampai, 'status' => $status_filter]) }}"
                                    class="btn btn-info" target="_blank">
                                    <i class="bi bi-printer"></i> Print
                                </a>
                            </div>
                        </div>

                        <div class="collapse" id="filterForm">
                            <form method="GET" action="{{ route('worksheet.index') }}" class="row g-3 mt-2">
                                <div class="col-md-3">
                                    <label for="tanggal_dari" class="form-label">Tanggal Dari</label>
                                    <input type="date" class="form-control" id="tanggal_dari" name="tanggal_dari"
                                        value="{{ $tanggal_dari }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="tanggal_sampai" class="form-label">Tanggal Sampai</label>
                                    <input type="date" class="form-control" id="tanggal_sampai" name="tanggal_sampai"
                                        value="{{ $tanggal_sampai }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="">Semua Status</option>
                                        <option value="Proses" {{ $status_filter === 'Proses' ? 'selected' : '' }}>Proses
                                        </option>
                                        <option value="Selesai" {{ $status_filter === 'Selesai' ? 'selected' : '' }}>Selesai
                                        </option>
                                        <option value="Batal" {{ $status_filter === 'Batal' ? 'selected' : '' }}>Batal
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="submit" class="btn btn-warning w-100">
                                        <i class="bi bi-search"></i> Cari
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jenis Pekerjaan</th>
                                    <th>Keterangan</th>
                                    <th>Perkiraan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($worksheets as $worksheet)
                                    <tr>
                                        <td>{{ ($worksheets->currentPage() - 1) * $worksheets->perPage() + $loop->iteration }}
                                        </td>
                                        <td>{{ $worksheet->tanggal->format('d/m/Y') }}</td>
                                        <td>{{ $worksheet->jenis_pekerjaan }}</td>
                                        <td>{{ Str::limit($worksheet->keterangan_pekerjaan, 50) }}</td>
                                        <td>{{ $worksheet->perkiraan_pekerjaan }}</td>
                                        <td>
                                            <span
                                                class="badge 
                                            @if ($worksheet->status === 'Proses') bg-warning
                                            @elseif($worksheet->status === 'Selesai') bg-success
                                            @else bg-danger @endif
                                        ">
                                                {{ $worksheet->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning edit-worksheet-btn"
                                                data-bs-toggle="modal" data-bs-target="#editWorksheetModal"
                                                data-worksheet="{{ json_encode($worksheet) }}">
                                                <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <form action="{{ route('worksheet.destroy', $worksheet) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus?')">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">Tidak ada data worksheet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($worksheets->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $worksheets->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Tambah Worksheet -->
    <div class="modal fade" id="addWorksheetModal" tabindex="-1" aria-labelledby="addWorksheetModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addWorksheetModalLabel">Tambah Worksheet Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('worksheet.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis_pekerjaan" class="form-label">Jenis Pekerjaan <span
                                    class="text-danger">*</span></label>
                            <select class="form-control selectpicker @error('jenis_pekerjaan') is-invalid @enderror"
                                id="jenis_pekerjaan" name="jenis_pekerjaan" data-live-search="true" required>
                                <option value="">-- Pilih Jenis Pekerjaan --</option>
                                <option value="Perbaikan" {{ old('jenis_pekerjaan') == 'Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                                <option value="Instalasi" {{ old('jenis_pekerjaan') == 'Instalasi' ? 'selected' : '' }}>Instalasi</option>
                                <option value="Reseting" {{ old('jenis_pekerjaan') == 'Reseting' ? 'selected' : '' }}>Reseting</option>
                                <option value="Lain-lain" {{ old('jenis_pekerjaan') == 'Lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                            </select>
                            @error('jenis_pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan_pekerjaan" class="form-label">Keterangan Pekerjaan <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('keterangan_pekerjaan') is-invalid @enderror" id="keterangan_pekerjaan"
                                name="keterangan_pekerjaan" rows="5" required>{{ old('keterangan_pekerjaan') }}</textarea>
                            @error('keterangan_pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="perkiraan_pekerjaan" class="form-label">Perkiraan Pekerjaan <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('perkiraan_pekerjaan') is-invalid @enderror"
                                id="perkiraan_pekerjaan" name="perkiraan_pekerjaan"
                                placeholder="Contoh: 2 jam, 1 hari, 1 minggu, dll"
                                value="{{ old('perkiraan_pekerjaan') }}" required>
                            @error('perkiraan_pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status_create" class="form-label">Status <span
                                    class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status_create"
                                name="status" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Proses" {{ old('status') === 'Proses' ? 'selected' : '' }}>Proses
                                </option>
                                <option value="Selesai" {{ old('status') === 'Selesai' ? 'selected' : '' }}>Selesai
                                </option>
                                <option value="Batal" {{ old('status') === 'Batal' ? 'selected' : '' }}>Batal</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Worksheet -->
    <div class="modal fade" id="editWorksheetModal" tabindex="-1" aria-labelledby="editWorksheetModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editWorksheetModalLabel">Edit Worksheet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editWorksheetForm" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="edit_tanggal" class="form-label">Tanggal <span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="edit_tanggal" name="tanggal" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_jenis_pekerjaan" class="form-label">Jenis Pekerjaan <span
                                    class="text-danger">*</span></label>
                            <select class="form-control selectpicker" id="edit_jenis_pekerjaan" name="jenis_pekerjaan" data-live-search="true" required>
                                <option value="">-- Pilih Jenis Pekerjaan --</option>
                                <option value="Perbaikan">Perbaikan</option>
                                <option value="Instalasi">Instalasi</option>
                                <option value="Reseting">Reseting</option>
                                <option value="Lain-lain">Lain-lain</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit_keterangan_pekerjaan" class="form-label">Keterangan Pekerjaan <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" id="edit_keterangan_pekerjaan" name="keterangan_pekerjaan" rows="5" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="edit_perkiraan_pekerjaan" class="form-label">Perkiraan Pekerjaan <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_perkiraan_pekerjaan"
                                name="perkiraan_pekerjaan" placeholder="Contoh: 2 jam, 1 hari, 1 minggu, dll" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="edit_status" name="status" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Batal">Batal</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Refresh selectpicker on modal shown
                $('#addWorksheetModal').on('shown.bs.modal', function () {
                    $('#jenis_pekerjaan').selectpicker('refresh');
                });

                $('#editWorksheetModal').on('show.bs.modal', function(event) {
                    const button = $(event.relatedTarget);
                    const worksheet = button.data('worksheet');

                    // Populate form fields
                    const modal = $(this);
                    modal.find('#edit_tanggal').val(worksheet.tanggal.substring(0, 10));
                    modal.find('#edit_jenis_pekerjaan').val(worksheet.jenis_pekerjaan);
                    modal.find('#edit_keterangan_pekerjaan').val(worksheet.keterangan_pekerjaan);
                    modal.find('#edit_perkiraan_pekerjaan').val(worksheet.perkiraan_pekerjaan);
                    modal.find('#edit_status').val(worksheet.status);

                    // Refresh selectpicker
                    modal.find('#edit_jenis_pekerjaan').selectpicker('refresh');

                    // Set form action
                    const action = "{{ route('worksheet.update', ':id') }}".replace(':id', worksheet.id);
                    modal.find('#editWorksheetForm').attr('action', action);
                });

                // If there are validation errors on create form, re-open the modal
                @if ($errors->any() && old('form_type') === 'create')
                    var addModal = new bootstrap.Modal(document.getElementById('addWorksheetModal'));
                    addModal.show();
                @endif
            });
        </script>
    @endpush
@endsection
