@extends('layouts.admin')

@section('title', 'Tulis Publikasi Baru - Panel Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Tulis Publikasi Baru</h3>
            <p class="text-muted small mb-0">Publikasikan berita, artikel edukasi, atau edaran resmi kemahasiswaan.</p>
        </div>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card-editorial p-4 bg-white mb-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Judul Publikasi <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="Tuliskan judul berita yang jelas dan informatif..." value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Ringkasan / Excerpt</label>
                        <textarea name="excerpt" rows="2" class="form-control form-control-sm" placeholder="Satu atau dua kalimat ringkasan untuk kartu preview...">{{ old('excerpt') }}</textarea>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small fw-semibold">Konten Lengkap Berita (Mendukung paragraf, daftar & kutipan) <span class="text-danger">*</span></label>
                        <textarea name="content" rows="12" class="form-control" placeholder="Ketikkan isi berita lengkap di sini..." required>{{ old('content') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card-editorial p-4 bg-white mb-4">
                    <h6 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--primary-green);">Pengaturan Penerbitan</h6>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Kategori Publikasi <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select form-select-sm" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select form-select-sm" required>
                            <option value="published" {{ old('status', 'published') === 'published' ? 'selected' : '' }}>Terbitkan Langsung</option>
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Simpan sebagai Draf</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Foto Sampul Utama</label>
                        <input type="file" name="featured_image" class="form-control form-control-sm">
                        <small class="text-muted" style="font-size: 0.72rem;">Format JPG/PNG rasio 16:9, maks 3MB.</small>
                    </div>

                    <button type="submit" class="btn btn-primary-bem w-100 mt-2">
                        <i class="bi bi-send me-1"></i> Simpan Publikasi
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
