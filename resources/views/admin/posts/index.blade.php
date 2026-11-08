@extends('layouts.admin')

@section('title', 'Manajemen Publikasi - Panel Admin')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Manajemen Berita & Publikasi</h3>
            <p class="text-muted small mb-0">Kelola artikel, berita kegiatan, dan pengumuman resmi BEM STIKS.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-bem">
                <i class="bi bi-tags me-1"></i> Kelola Kategori
            </a>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-primary-bem">
                <i class="bi bi-plus-lg me-1"></i> Buat Berita Baru
            </a>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="card-editorial p-3 bg-white mb-4">
        <form action="{{ route('admin.posts.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari judul publikasi..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Diterbitkan</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draf</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-sm btn-primary-bem w-100">Filter</button>
                @if(request('search') || request('category') || request('status'))
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Posts Table -->
    <div class="card-editorial p-0 overflow-hidden bg-white shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small text-uppercase fw-bold text-muted">
                    <tr>
                        <th class="ps-4">Judul Publikasi</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Tanggal Terbit</th>
                        <th>Dibaca</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @forelse($posts as $p)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset($p->featured_image ?? 'images/posts/post-1.jpg') }}" alt="{{ $p->title }}" class="rounded object-fit-cover border" width="44" height="34">
                                    <div>
                                        <a href="{{ route('posts.show', $p->slug) }}" target="_blank" class="fw-bold text-dark text-decoration-none">
                                            {{ Str::limit($p->title, 55) }}
                                        </a>
                                        <small class="text-muted d-block text-truncate" style="max-width: 250px;">{{ $p->excerpt }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge" style="background-color: {{ $p->category->color ?? '#123F29' }}; color: #FFFFFF; font-size: 0.72rem;">
                                    {{ $p->category->name }}
                                </span>
                            </td>
                            <td>{{ $p->user->name ?? 'Admin' }}</td>
                            <td>
                                @if($p->status === 'published')
                                    <span class="badge bg-success small"><i class="bi bi-check-circle me-1"></i> Terbit</span>
                                @else
                                    <span class="badge bg-secondary small"><i class="bi bi-file-earmark me-1"></i> Draf</span>
                                @endif
                            </td>
                            <td>{{ $p->published_at ? $p->published_at->format('d/m/Y H:i') : '-' }}</td>
                            <td>{{ $p->views_count }}x</td>
                            <td class="text-end pe-4">
                                <a href="{{ route('posts.show', $p->slug) }}" target="_blank" class="btn btn-sm btn-light border p-1 px-2" title="Lihat">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.posts.edit', $p) }}" class="btn btn-sm btn-light border p-1 px-2" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.posts.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus publikasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border text-danger p-1 px-2" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada publikasi yang cocok.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3 border-top d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
