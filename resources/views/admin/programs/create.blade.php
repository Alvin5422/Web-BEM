@extends('layouts.admin')

@section('title', 'Tambah Program Kerja - Panel Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Tambah Program Kerja</h3>
            <p class="text-muted small mb-0">Rencanakan agenda program kerja kabinet BEM STIKS.</p>
        </div>
        <a href="{{ route('admin.programs.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card-editorial p-4 bg-white max-w-800">
        <form action="{{ route('admin.programs.store') }}" method="POST">
            @csrf
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Pilih Periode / Kabinet <span class="text-danger">*</span></label>
                    <select name="period_id" class="form-select form-select-sm" required>
                        @foreach($periods as $p)
                            <option value="{{ $p->id }}" {{ $activePeriod && $activePeriod->id == $p->id ? 'selected' : '' }}>
                                {{ $p->cabinet_name }} ({{ $p->name }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Bidang / Departemen Pelaksana <span class="text-danger">*</span></label>
                    <select name="department" class="form-select form-select-sm" required>
                        <option value="Advokasi & Kesejahteraan Mahasiswa">Advokasi & Kesejahteraan Mahasiswa</option>
                        <option value="Pengabdian Masyarakat & Aksi Sosial">Pengabdian Masyarakat & Aksi Sosial</option>
                        <option value="Pengembangan Karakter & Kaderisasi">Pengembangan Karakter & Kaderisasi</option>
                        <option value="Komunikasi & Informasi">Komunikasi & Informasi</option>
                        <option value="Minat Bakat & Penalaran">Minat Bakat & Penalaran</option>
                        <option value="BPH Inti">BPH Inti</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-semibold">Nama Program Kerja <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control form-control-sm" placeholder="Contoh: Bina Desa Sosial Mahasiswa Pesisir" value="{{ old('name') }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-semibold">Deskripsi Program <span class="text-danger">*</span></label>
                    <textarea name="description" rows="3" class="form-control form-control-sm" placeholder="Uraikan gambaran umum program dan bentuk kegiatannya..." required>{{ old('description') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Tujuan Program</label>
                    <input type="text" name="objective" class="form-control form-control-sm" placeholder="Target output / capaian..." value="{{ old('objective') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Sasaran Peserta / Penerima Manfaat</label>
                    <input type="text" name="target_audience" class="form-control form-control-sm" placeholder="Contoh: Mahasiswa Baru & Warga Binaan" value="{{ old('target_audience') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Status Pelaksanaan <span class="text-danger">*</span></label>
                    <select name="status" class="form-select form-select-sm" required>
                        <option value="direncanakan" {{ old('status') === 'direncanakan' ? 'selected' : '' }}>Direncanakan</option>
                        <option value="berjalan" {{ old('status') === 'berjalan' ? 'selected' : '' }}>Sedang Berjalan</option>
                        <option value="selesai" {{ old('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="form-control form-control-sm" value="{{ old('start_date') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Tanggal Selesai</label>
                    <input type="date" name="end_date" class="form-control form-control-sm" value="{{ old('end_date') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Penanggung Jawab (PJ)</label>
                    <input type="text" name="person_in_charge" class="form-control form-control-sm" placeholder="Contoh: Rian Alamsyah (Kabid)" value="{{ old('person_in_charge') }}">
                </div>
                <div class="col-md-6 d-flex align-items-center pt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                        <label class="form-check-label small fw-semibold" for="is_featured">
                            Tampilkan sebagai Program Unggulan di Beranda
                        </label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary-bem">
                <i class="bi bi-save me-1"></i> Simpan Program Kerja
            </button>
        </form>
    </div>
@endsection
