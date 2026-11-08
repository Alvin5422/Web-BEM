@extends('layouts.admin')

@section('title', 'Tambah Agenda Kegiatan - Panel Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Tambah Agenda Kegiatan</h3>
            <p class="text-muted small mb-0">Jadwalkan agenda atau kegiatan organisasi ke dalam kalender.</p>
        </div>
        <a href="{{ route('admin.events.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card-editorial p-4 bg-white max-w-800">
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3 mb-3">
                <div class="col-12">
                    <label class="form-label small fw-semibold">Nama / Judul Kegiatan <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control form-control-sm" placeholder="Contoh: Seminar Nasional Kesejahteraan Sosial" value="{{ old('title') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Terkait Program Kerja (Opsional)</label>
                    <select name="program_id" class="form-select form-select-sm">
                        <option value="">-- Kegiatan Independen / Umum --</option>
                        @foreach($programs as $prog)
                            <option value="{{ $prog->id }}" {{ old('program_id') == $prog->id ? 'selected' : '' }}>{{ $prog->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Status Pelaksanaan <span class="text-danger">*</span></label>
                    <select name="status" class="form-select form-select-sm" required>
                        <option value="mendatang" {{ old('status') === 'mendatang' ? 'selected' : '' }}>Mendatang</option>
                        <option value="berlangsung" {{ old('status') === 'berlangsung' ? 'selected' : '' }}>Sedang Berlangsung</option>
                        <option value="selesai" {{ old('status') === 'selesai' ? 'selected' : '' }}>Telah Selesai</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Tanggal Kegiatan <span class="text-danger">*</span></label>
                    <input type="date" name="event_date" class="form-control form-control-sm" value="{{ old('event_date') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Jam Mulai</label>
                    <input type="time" name="start_time" class="form-control form-control-sm" value="{{ old('start_time') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Jam Selesai</label>
                    <input type="time" name="end_time" class="form-control form-control-sm" value="{{ old('end_time') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Lokasi Pelaksanaan <span class="text-danger">*</span></label>
                    <input type="text" name="location" class="form-control form-control-sm" placeholder="Contoh: Auditorium STIKS Tamalanrea Makassar" value="{{ old('location') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Tautan Pendaftaran (Opsional)</label>
                    <input type="url" name="registration_link" class="form-control form-control-sm" placeholder="https://..." value="{{ old('registration_link') }}">
                </div>
                <div class="col-12">
                    <label class="form-label small fw-semibold">Poster Kegiatan (Opsional)</label>
                    <input type="file" name="poster" class="form-control form-control-sm">
                </div>
                <div class="col-12">
                    <label class="form-label small fw-semibold">Uraian / Deskripsi Kegiatan</label>
                    <textarea name="description" rows="3" class="form-control form-control-sm" placeholder="Rincian informasi agenda...">{{ old('description') }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary-bem">
                <i class="bi bi-save me-1"></i> Simpan Agenda
            </button>
        </form>
    </div>
@endsection
