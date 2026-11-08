@extends('layouts.admin')

@section('title', 'Kategori Publikasi - Panel Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Kategori Publikasi</h3>
            <p class="text-muted small mb-0">Kelola kelompok jenis warta dan artikel BEM STIKS.</p>
        </div>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Berita
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card-editorial p-0 overflow-hidden bg-white shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small text-uppercase fw-bold text-muted">
                            <tr>
                                <th class="ps-4">Nama Kategori</th>
                                <th>Slug</th>
                                <th>Publikasi</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            @foreach($categories as $cat)
                                <tr>
                                    <td class="ps-4">
                                        <span class="badge me-1" style="background-color: {{ $cat->color }}; color: #FFF;">•</span>
                                        <strong class="text-dark">{{ $cat->name }}</strong>
                                        @if($cat->description)
                                            <small class="text-muted d-block">{{ $cat->description }}</small>
                                        @endif
                                    </td>
                                    <td><code>{{ $cat->slug }}</code></td>
                                    <td>{{ $cat->posts_count }} Berita</td>
                                    <td class="text-end pe-4">
                                        <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border text-danger p-1 px-2" {{ $cat->posts_count > 0 ? 'disabled' : '' }} title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card-editorial p-4 bg-white">
                <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--primary-green);">Tambah Kategori Baru</h5>
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-control-sm" placeholder="Contoh: Advokasi Mahasiswa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Warna Label (HEX)</label>
                        <input type="color" name="color" class="form-control form-control-color w-100" value="#123F29">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Deskripsi Singkat</label>
                        <textarea name="description" rows="2" class="form-control form-control-sm" placeholder="Keterangan singkat kategori..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary-bem w-100">
                        <i class="bi bi-plus-lg me-1"></i> Simpan Kategori
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
