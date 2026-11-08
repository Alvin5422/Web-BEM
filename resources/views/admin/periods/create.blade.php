@extends('layouts.admin')

@section('title', 'Tambah Periode Kepengurusan - Panel Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Tambah Periode Kepengurusan</h3>
            <p class="text-muted small mb-0">Daftarkan kabinet atau masa bakti BEM STIKS Tamalanrea yang baru.</p>
        </div>
        <a href="{{ route('admin.periods.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card-editorial p-4 bg-white max-w-800">
        <form action="{{ route('admin.periods.store') }}" method="POST">
            @csrf
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Nama Periode (Contoh: 2026/2027) <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control form-control-sm" placeholder="2026/2027" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Nama Kabinet <span class="text-danger">*</span></label>
                    <input type="text" name="cabinet_name" class="form-control form-control-sm" placeholder="Kabinet Ananta Anardhaya" value="{{ old('cabinet_name') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Nama Ketua BEM <span class="text-danger">*</span></label>
                    <input type="text" name="leader_name" class="form-control form-control-sm" placeholder="Nama Lengkap Ketua..." value="{{ old('leader_name') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Nama Wakil Ketua BEM</label>
                    <input type="text" name="vice_leader_name" class="form-control form-control-sm" placeholder="Nama Lengkap Wakil..." value="{{ old('vice_leader_name') }}">
                </div>
                <div class="col-12">
                    <label class="form-label small fw-semibold">Slogan / Motto Kabinet</label>
                    <input type="text" name="motto" class="form-control form-control-sm" placeholder="Contoh: Abadi dalam Kebaikan, Nyata dalam Pengabdian" value="{{ old('motto') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Tahun Mulai <span class="text-danger">*</span></label>
                    <input type="number" name="start_year" class="form-control form-control-sm" value="{{ old('start_year', date('Y')) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Tahun Selesai <span class="text-danger">*</span></label>
                    <input type="number" name="end_year" class="form-control form-control-sm" value="{{ old('end_year', date('Y') + 1) }}" required>
                </div>
            </div>

            <div class="form-check form-switch p-3 bg-light rounded-3 mb-4 border">
                <input class="form-check-input ms-0 me-2" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                <label class="form-check-label fw-semibold small text-dark" for="is_active">
                    Jadikan sebagai Kabinet Aktif Resmi Website
                </label>
            </div>

            <button type="submit" class="btn btn-primary-bem">
                <i class="bi bi-save me-1"></i> Simpan Periode Baru
            </button>
        </form>
    </div>
@endsection
