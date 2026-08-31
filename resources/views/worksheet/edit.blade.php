@extends('layouts.main')

@section('container')
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h5 class="mb-0">Edit Worksheet</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('worksheet.update', $worksheet) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    id="tanggal" name="tanggal"
                                    value="{{ old('tanggal', $worksheet->tanggal->format('Y-m-d')) }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jenis_pekerjaan" class="form-label">Jenis Pekerjaan <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('jenis_pekerjaan') is-invalid @enderror"
                                    id="jenis_pekerjaan" name="jenis_pekerjaan"
                                    placeholder="Contoh: Perbaikan, Instalasi, Reseting, dll"
                                    value="{{ old('jenis_pekerjaan', $worksheet->jenis_pekerjaan) }}" required>
                                @error('jenis_pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="keterangan_pekerjaan" class="form-label">Keterangan Pekerjaan <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control @error('keterangan_pekerjaan') is-invalid @enderror" id="keterangan_pekerjaan"
                                    name="keterangan_pekerjaan" rows="5" required>{{ old('keterangan_pekerjaan', $worksheet->keterangan_pekerjaan) }}</textarea>
                                @error('keterangan_pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="perkiraan_pekerjaan" class="form-label">Perkiraan Pekerjaan <span
                                        class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control @error('perkiraan_pekerjaan') is-invalid @enderror"
                                    id="perkiraan_pekerjaan" name="perkiraan_pekerjaan"
                                    placeholder="Contoh: 2 jam, 1 hari, 1 minggu, dll"
                                    value="{{ old('perkiraan_pekerjaan', $worksheet->perkiraan_pekerjaan) }}" required>
                                @error('perkiraan_pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status"
                                    name="status" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Proses"
                                        {{ old('status', $worksheet->status) === 'Proses' ? 'selected' : '' }}>Proses
                                    </option>
                                    <option value="Selesai"
                                        {{ old('status', $worksheet->status) === 'Selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                    <option value="Batal"
                                        {{ old('status', $worksheet->status) === 'Batal' ? 'selected' : '' }}>Batal
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-save"></i> Update
                                </button>
                                <a href="{{ route('worksheet.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
