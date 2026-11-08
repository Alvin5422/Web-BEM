@extends('layouts.admin')

@section('title', 'Kelola Profil BEM - Panel Administrasi')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Profil & Nilai Kelembagaan BEM</h3>
            <p class="text-muted small mb-0">Kelola sambutan ketua BEM, visi, misi, sejarah, dan filosofi lambang resmi.</p>
        </div>
    </div>

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <!-- 1. Sambutan Ketua -->
            <div class="col-lg-6">
                <div class="card-editorial p-4 bg-white h-100">
                    <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--primary-green);">
                        <i class="bi bi-person-video3 text-warning me-2"></i> Sambutan Ketua BEM
                    </h5>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Lengkap Ketua BEM</label>
                        <input type="text" name="sambutan_ketua_nama" class="form-control form-control-sm" value="{{ old('sambutan_ketua_nama', $siteSettings['sambutan_ketua_nama'] ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Jabatan / Periode</label>
                        <input type="text" name="sambutan_ketua_periode" class="form-control form-control-sm" value="{{ old('sambutan_ketua_periode', $siteSettings['sambutan_ketua_periode'] ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Foto Formal Ketua BEM</label>
                        <div class="d-flex gap-3 align-items-center">
                            @if(!empty($siteSettings['sambutan_ketua_foto']))
                                <img src="{{ asset($siteSettings['sambutan_ketua_foto']) }}" alt="Foto Ketua" class="rounded object-fit-cover border" width="60" height="70">
                            @endif
                            <input type="file" name="sambutan_ketua_foto" class="form-control form-control-sm">
                        </div>
                        <small class="text-muted" style="font-size: 0.75rem;">Format JPG/PNG, ukuran proporsional 4:5, maks 2MB.</small>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small fw-semibold">Isi Teks Sambutan</label>
                        <textarea name="sambutan_ketua_text" rows="5" class="form-control form-control-sm" required>{{ old('sambutan_ketua_text', $siteSettings['sambutan_ketua_text'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- 2. Visi & Misi -->
            <div class="col-lg-6">
                <div class="card-editorial p-4 bg-white h-100">
                    <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--primary-green);">
                        <i class="bi bi-compass text-warning me-2"></i> Visi & Misi Organisasi
                    </h5>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Visi BEM STIKS Tamalanrea</label>
                        <textarea name="visi" rows="3" class="form-control form-control-sm" required>{{ old('visi', $siteSettings['visi'] ?? '') }}</textarea>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small fw-semibold">Misi Organisasi (Satu baris per poin misi)</label>
                        <textarea name="misi" rows="6" class="form-control form-control-sm" required>{{ old('misi', $siteSettings['misi'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- 3. Sejarah -->
            <div class="col-lg-6">
                <div class="card-editorial p-4 bg-white h-100">
                    <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--primary-green);">
                        <i class="bi bi-clock-history text-warning me-2"></i> Sejarah BEM STIKS
                    </h5>
                    <div class="mb-0">
                        <label class="form-label small fw-semibold">Latar Belakang & Sejarah Pendirian</label>
                        <textarea name="sejarah" rows="6" class="form-control form-control-sm" required>{{ old('sejarah', $siteSettings['sejarah'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- 4. Filosofi Logo -->
            <div class="col-lg-6">
                <div class="card-editorial p-4 bg-white h-100">
                    <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--primary-green);">
                        <i class="bi bi-shield-shaded text-warning me-2"></i> Filosofi Lambang & Logo
                    </h5>
                    <div class="mb-0">
                        <label class="form-label small fw-semibold">Uraian Makna Lambang (Ukiran etnik, perisai, pena & buku, warna)</label>
                        <textarea name="filosofi_logo" rows="6" class="form-control form-control-sm" required>{{ old('filosofi_logo', $siteSettings['filosofi_logo'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary-bem px-4 py-2">
                    <i class="bi bi-save me-1"></i> Simpan Perubahan Profil
                </button>
            </div>
        </div>
    </form>
@endsection
