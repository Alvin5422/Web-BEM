@extends('layouts.admin')

@section('title', 'Edit Periode Kepengurusan - Panel Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Edit Periode Kepengurusan</h3>
            <p class="text-muted small mb-0">Perbarui data kabinet atau masa bakti BEM STIKS.</p>
        </div>
        <a href="{{ route('admin.periods.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card-editorial p-4 bg-white max-w-800">
        <form action="{{ route('admin.periods.update', $period) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Nama Periode <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control form-control-sm" value="{{ old('name', $period->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Nama Kabinet <span class="text-danger">*</span></label>
                    <input type="text" name="cabinet_name" class="form-control form-control-sm" value="{{ old('cabinet_name', $period->cabinet_name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Nama Ketua BEM <span class="text-danger">*</span></label>
                    <input type="text" name="leader_name" class="form-control form-control-sm" value="{{ old('leader_name', $period->leader_name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Nama Wakil Ketua BEM</label>
                    <input type="text" name="vice_leader_name" class="form-control form-control-sm" value="{{ old('vice_leader_name', $period->vice_leader_name) }}">
                </div>
                <div class="col-12">
                    <label class="form-label small fw-semibold">Slogan / Motto Kabinet</label>
                    <input type="text" name="motto" class="form-control form-control-sm" value="{{ old('motto', $period->motto) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Tahun Mulai <span class="text-danger">*</span></label>
                    <input type="number" name="start_year" class="form-control form-control-sm" value="{{ old('start_year', $period->start_year) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Tahun Selesai <span class="text-danger">*</span></label>
                    <input type="number" name="end_year" class="form-control form-control-sm" value="{{ old('end_year', $period->end_year) }}" required>
                </div>
            </div>

            <div class="form-check form-switch p-3 bg-light rounded-3 mb-4 border">
                <input class="form-check-input ms-0 me-2" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $period->is_active) ? 'checked' : '' }}>
                <label class="form-check-label fw-semibold small text-dark" for="is_active">
                    Jadikan sebagai Kabinet Aktif Resmi Website
                </label>
            </div>

            <button type="submit" class="btn btn-primary-bem">
                <i class="bi bi-save me-1"></i> Perbarui Periode
            </button>
        </form>
    </div>
@endsection
