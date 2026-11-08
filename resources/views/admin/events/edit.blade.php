@extends('layouts.admin')

@section('title', 'Edit Agenda Kegiatan - Panel Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Edit Agenda Kegiatan</h3>
            <p class="text-muted small mb-0">Perbarui rincian jadwal atau lokasi kegiatan organisasi.</p>
        </div>
        <a href="{{ route('admin.events.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card-editorial p-4 bg-white max-w-800">
        <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3 mb-3">
                <div class="col-12">
                    <label class="form-label small fw-semibold">Nama / Judul Kegiatan <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control form-control-sm" value="{{ old('title', $event->title) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Terkait Program Kerja (Opsional)</label>
                    <select name="program_id" class="form-select form-select-sm">
                        <option value="">-- Kegiatan Independen / Umum --</option>
                        @foreach($programs as $prog)
                            <option value="{{ $prog->id }}" {{ $event->program_id == $prog->id ? 'selected' : '' }}>{{ $prog->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Status Pelaksanaan <span class="text-danger">*</span></label>
                    <select name="status" class="form-select form-select-sm" required>
                        <option value="mendatang" {{ old('status', $event->status) === 'mendatang' ? 'selected' : '' }}>Mendatang</option>
                        <option value="berlangsung" {{ old('status', $event->status) === 'berlangsung' ? 'selected' : '' }}>Sedang Berlangsung</option>
                        <option value="selesai" {{ old('status', $event->status) === 'selesai' ? 'selected' : '' }}>Telah Selesai</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Tanggal Kegiatan <span class="text-danger">*</span></label>
                    <input type="date" name="event_date" class="form-control form-control-sm" value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Jam Mulai</label>
                    <input type="time" name="start_time" class="form-control form-control-sm" value="{{ old('start_time', $event->start_time) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Jam Selesai</label>
                    <input type="time" name="end_time" class="form-control form-control-sm" value="{{ old('end_time', $event->end_time) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Lokasi Pelaksanaan <span class="text-danger">*</span></label>
                    <input type="text" name="location" class="form-control form-control-sm" value="{{ old('location', $event->location) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Tautan Pendaftaran (Opsional)</label>
                    <input type="url" name="registration_link" class="form-control form-control-sm" value="{{ old('registration_link', $event->registration_link) }}">
                </div>
                <div class="col-12">
                    <label class="form-label small fw-semibold">Poster Kegiatan</label>
                    @if($event->poster)
                        <div class="mb-2">
                            <img src="{{ asset($event->poster) }}" alt="Poster" class="rounded border" width="90">
                        </div>
                    @endif
                    <input type="file" name="poster" class="form-control form-control-sm">
                </div>
                <div class="col-12">
                    <label class="form-label small fw-semibold">Uraian / Deskripsi Kegiatan</label>
                    <textarea name="description" rows="3" class="form-control form-control-sm">{{ old('description', $event->description) }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary-bem">
                <i class="bi bi-save me-1"></i> Perbarui Agenda
            </button>
        </form>
    </div>
@endsection
