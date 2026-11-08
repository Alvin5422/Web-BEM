@extends('layouts.admin')

@section('title', 'Edit Publikasi - Panel Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Edit Publikasi</h3>
            <p class="text-muted small mb-0">Perbarui materi warta atau artikel yang telah dibuat.</p>
        </div>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card-editorial p-4 bg-white mb-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Judul Publikasi <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Ringkasan / Excerpt</label>
                        <textarea name="excerpt" rows="2" class="form-control form-control-sm">{{ old('excerpt', $post->excerpt) }}</textarea>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small fw-semibold">Konten Lengkap Berita <span class="text-danger">*</span></label>
                        <textarea name="content" rows="12" class="form-control" required>{{ old('content', $post->content) }}</textarea>
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
                                <option value="{{ $cat->id }}" {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select form-select-sm" required>
                            <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Diterbitkan</option>
                            <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draf</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Foto Sampul Utama</label>
                        @if($post->featured_image)
                            <div class="mb-2">
                                <img src="{{ asset($post->featured_image) }}" alt="Sampul" class="rounded object-fit-cover w-100" style="max-height: 140px;">
                            </div>
                        @endif
                        <input type="file" name="featured_image" class="form-control form-control-sm">
                    </div>

                    <button type="submit" class="btn btn-primary-bem w-100 mt-2">
                        <i class="bi bi-save me-1"></i> Perbarui Publikasi
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
