@extends('layouts.app')

@section('title', 'Berita & Kegiatan - BEM STIKS Tamalanrea Makassar')

@section('content')
    <!-- Page Header -->
    <section class="py-5 bg-white border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb small mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-green);">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Berita & Kegiatan</li>
                </ol>
            </nav>
            <div class="section-pretitle">Kanal Informasi Resmi</div>
            <h1 class="heading-font fw-bold mb-2" style="color: var(--primary-green); font-size: 2.3rem;">
                Berita, Kegiatan & Pengumuman
            </h1>
            <p class="text-muted mb-0" style="font-size: 1.05rem;">
                Publikasi resmi program kerja, kegiatan sosial, artikel edukasi, dan edaran kemahasiswaan STIKS Tamalanrea Makassar.
            </p>
        </div>
    </section>

    <!-- Filter & Search Bar -->
    <div class="py-4 bg-light border-bottom">
        <div class="container">
            <div class="row g-3 align-items-center">
                <!-- Category Pills -->
                <div class="col-lg-8">
                    <div class="d-flex overflow-auto gap-2 pb-1 text-nowrap">
                        <a href="{{ route('posts.index') }}" class="btn btn-sm {{ !request('category') ? 'btn-primary-bem' : 'btn-outline-secondary' }}">
                            Semua Kategori
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('posts.index', ['category' => $cat->slug]) }}" class="btn btn-sm {{ request('category') === $cat->slug ? 'btn-primary-bem' : 'btn-outline-secondary' }}">
                                {{ $cat->name }} <span class="badge bg-light text-dark ms-1">{{ $cat->posts_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Search Input -->
                <div class="col-lg-4">
                    <form action="{{ route('posts.index') }}" method="GET">
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <div class="input-group">
                            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari judul berita..." value="{{ request('search') }}">
                            <button class="btn btn-primary-bem btn-sm" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Posts Grid -->
    <section class="py-5 section-warm">
        <div class="container">
            @if(request('search'))
                <div class="alert alert-info py-2 px-3 small mb-4 d-flex justify-content-between align-items-center">
                    <span>Hasil pencarian untuk kata kunci: <strong>"{{ request('search') }}"</strong></span>
                    <a href="{{ route('posts.index') }}" class="btn btn-sm btn-link text-decoration-none">Hapus Filter</a>
                </div>
            @endif

            <div class="row g-4">
                @forelse($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="card-editorial p-0 overflow-hidden d-flex flex-column justify-content-between bg-white">
                            <div>
                                <div class="position-relative" style="height: 210px; overflow: hidden;">
                                    <img src="{{ asset($post->featured_image ?? 'images/posts/post-1.jpg') }}" alt="{{ $post->title }}" class="w-100 h-100 object-fit-cover">
                                    <div class="position-absolute top-0 start-0 m-3">
                                        <span class="badge" style="background-color: {{ $post->category->color ?? '#123F29' }}; color: #FFFFFF;">
                                            {{ $post->category->name }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="text-muted small mb-2 d-flex align-items-center gap-2">
                                        <span><i class="bi bi-calendar3 me-1"></i> {{ $post->published_at ? $post->published_at->format('d M Y') : 'Draf' }}</span>
                                        <span>&bull;</span>
                                        <span><i class="bi bi-eye me-1"></i> {{ $post->views_count }} dibaca</span>
                                    </div>
                                    <h5 class="fw-bold mb-2">
                                        <a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none text-dark">
                                            {{ $post->title }}
                                        </a>
                                    </h5>
                                    <p class="text-muted small mb-0">
                                        {{ Str::limit($post->excerpt, 120) }}
                                    </p>
                                </div>
                            </div>
                            <div class="px-4 pb-4">
                                <a href="{{ route('posts.show', $post->slug) }}" class="fw-semibold small text-decoration-none" style="color: var(--primary-green);">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-file-earmark-text text-muted" style="font-size: 3rem;"></i>
                        <h5 class="fw-bold text-muted mt-3">Tidak ada publikasi yang ditemukan</h5>
                        <p class="text-muted small">Coba ubah kata kunci pencarian atau pilih kategori lain.</p>
                        <a href="{{ route('posts.index') }}" class="btn btn-outline-bem btn-sm">Lihat Semua Berita</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
@endsection
