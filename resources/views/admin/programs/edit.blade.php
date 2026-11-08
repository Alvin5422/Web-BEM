@extends('layouts.admin')

@section('title', 'Edit Program Kerja - Panel Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Edit Program Kerja</h3>
            <p class="text-muted small mb-0">Perbarui rincian program kerja dan status pelaksanaannya.</p>
        </div>
        <a href="{{ route('admin.programs.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card-editorial p-4 bg-white max-w-800">
        <form action="{{ route('admin.programs.update', $program) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Pilih Periode / Kabinet <span class="text-danger">*</span></label>
                    <select name="period_id" class="form-select form-select-sm" required>
                        @foreach($periods as $p)
                            <option value="{{ $p->id }}" {{ $program->period_id == $p->id ? 'selected' : '' }}>
                                {{ $p->cabinet_name }} ({{ $p->name }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Bidang / Departemen Pelaksana <span class="text-danger">*</span></label>
                    <select name="department" class="form-select form-select-sm" required>
                        @foreach(['Advokasi & Kesejahteraan Mahasiswa', 'Pengabdian Masyarakat & Aksi Sosial', 'Pengembangan Karakter & Kaderisasi', 'Komunikasi & Informasi', 'Minat Bakat & Penalaran', 'BPH Inti'] as $dept)
                            <option value="{{ $dept }}" {{ $program->department === $dept ? 'selected' : '' }}>{{ $dept }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-semibold">Nama Program Kerja <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control form-control-sm" value="{{ old('name', $program->name) }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-semibold">Deskripsi Program <span class="text-danger">*</span></label>
                    <textarea name="description" rows="3" class="form-control form-control-sm" required>{{ old('description', $program->description) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Tujuan Program</label>
                    <input type="text" name="objective" class="form-control form-control-sm" value="{{ old('objective', $program->objective) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Sasaran Peserta</label>
                    <input type="text" name="target_audience" class="form-control form-control-sm" value="{{ old('target_audience', $program->target_audience) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Status Pelaksanaan <span class="text-danger">*</span></label>
                    <select name="status" class="form-select form-select-sm" required>
                        <option value="direncanakan" {{ old('status', $program->status) === 'direncanakan' ? 'selected' : '' }}>Direncanakan</option>
                        <option value="berjalan" {{ old('status', $program->status) === 'berjalan' ? 'selected' : '' }}>Sedang Berjalan</option>
                        <option value="selesai" {{ old('status', $program->status) === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="form-control form-control-sm" value="{{ old('start_date', $program->start_date ? $program->start_date->format('Y-m-d') : '') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Tanggal Selesai</label>
                    <input type="date" name="end_date" class="form-control form-control-sm" value="{{ old('end_date', $program->end_date ? $program->end_date->format('Y-m-d') : '') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Penanggung Jawab (PJ)</label>
                    <input type="text" name="person_in_charge" class="form-control form-control-sm" value="{{ old('person_in_charge', $program->person_in_charge) }}">
                </div>
                <div class="col-md-6 d-flex align-items-center pt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $program->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label small fw-semibold" for="is_featured">
                            Tampilkan sebagai Program Unggulan di Beranda
                        </label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary-bem">
                <i class="bi bi-save me-1"></i> Perbarui Program Kerja
            </button>
        </form>
    </div>
@endsection
