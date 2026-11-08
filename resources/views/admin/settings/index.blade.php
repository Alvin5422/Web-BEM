@extends('layouts.admin')

@section('title', 'Pengaturan Website - Panel Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Pengaturan Website & Identitas</h3>
            <p class="text-muted small mb-0">Kelola identitas digital, narahubung, alamat sekretariat, dan logo institusi.</p>
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <!-- 1. Identitas Website -->
            <div class="col-lg-6">
                <div class="card-editorial p-4 bg-white h-100">
                    <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--primary-green);">
                        <i class="bi bi-gear-fill text-warning me-2"></i> Identitas Digital
                    </h5>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Organisasi / Situs <span class="text-danger">*</span></label>
                        <input type="text" name="site_name" class="form-control form-control-sm" value="{{ old('site_name', $siteSettings['site_name'] ?? 'BEM STIKS Tamalanrea Makassar') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Perguruan Tinggi <span class="text-danger">*</span></label>
                        <input type="text" name="campus_name" class="form-control form-control-sm" value="{{ old('campus_name', $siteSettings['campus_name'] ?? 'Sekolah Tinggi Ilmu Kesejahteraan Sosial Tamalanrea Makassar') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Singkat Kampus</label>
                        <input type="text" name="campus_short" class="form-control form-control-sm" value="{{ old('campus_short', $siteSettings['campus_short'] ?? 'STIKS Tamalanrea Makassar') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Tagline / Slogan Situs <span class="text-danger">*</span></label>
                        <input type="text" name="tagline" class="form-control form-control-sm" value="{{ old('tagline', $siteSettings['tagline'] ?? 'Ruang Berkarya, Bergerak, dan Mengabdi') }}" required>
                    </div>

                    <div class="row g-2">
                        <div class="col-sm-6">
                            <label class="form-label small fw-semibold">Logo BEM</label>
                            @if(!empty($siteSettings['logo_bem']))
                                <div class="mb-2">
                                    <img src="{{ asset($siteSettings['logo_bem']) }}" alt="Logo BEM" class="border p-1 rounded" height="40">
                                </div>
                            @endif
                            <input type="file" name="logo_bem" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label small fw-semibold">Logo Kampus STIKS</label>
                            @if(!empty($siteSettings['logo_campus']))
                                <div class="mb-2">
                                    <img src="{{ asset($siteSettings['logo_campus']) }}" alt="Logo Kampus" class="border p-1 rounded" height="40">
                                </div>
                            @endif
                            <input type="file" name="logo_campus" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Narahubung & Alamat -->
            <div class="col-lg-6">
                <div class="card-editorial p-4 bg-white h-100">
                    <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--primary-green);">
                        <i class="bi bi-telephone-fill text-warning me-2"></i> Kontak & Media Sosial Resmi
                    </h5>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Email Resmi BEM <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control form-control-sm" value="{{ old('email', $siteSettings['email'] ?? 'bem@stikstamalanrea.ac.id') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Telepon / WhatsApp</label>
                            <input type="text" name="phone" class="form-control form-control-sm" value="{{ old('phone', $siteSettings['phone'] ?? '+62 821-9988-7766') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Tautan Instagram</label>
                            <input type="text" name="instagram" class="form-control form-control-sm" value="{{ old('instagram', $siteSettings['instagram'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Tautan YouTube</label>
                            <input type="text" name="youtube" class="form-control form-control-sm" value="{{ old('youtube', $siteSettings['youtube'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Tautan TikTok</label>
                            <input type="text" name="tiktok" class="form-control form-control-sm" value="{{ old('tiktok', $siteSettings['tiktok'] ?? '') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Alamat Lengkap Sekretariat <span class="text-danger">*</span></label>
                        <textarea name="address" rows="2" class="form-control form-control-sm" required>{{ old('address', $siteSettings['address'] ?? '') }}</textarea>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small fw-semibold">URL Embed Google Maps</label>
                        <input type="text" name="maps_embed_url" class="form-control form-control-sm" value="{{ old('maps_embed_url', $siteSettings['maps_embed_url'] ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary-bem px-4 py-2">
                    <i class="bi bi-save me-1"></i> Simpan Konfigurasi Website
                </button>
            </div>
        </div>
    </form>
@endsection
