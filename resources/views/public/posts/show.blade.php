@extends('layouts.app')

@section('title', $post->title . ' - BEM STIKS Tamalanrea Makassar')
@section('meta_description', Str::limit(strip_tags($post->excerpt ?? $post->content), 150))

@section('content')
    <!-- Article Header -->
    <section class="py-5 bg-white border-bottom">
        <div class="container">
            <div class="max-w-800 mx-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb small mb-3">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-green);">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}" class="text-decoration-none" style="color: var(--primary-green);">Berita</a></li>
                        <li class="breadcrumb-item active text-truncate" aria-current="page">{{ Str::limit($post->title, 40) }}</li>
                    </ol>
                </nav>

                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge" style="background-color: {{ $post->category->color ?? '#123F29' }}; color: #FFFFFF;">
                        {{ $post->category->name }}
                    </span>
                    <span class="text-muted small">&bull;</span>
                    <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i> {{ $post->published_at ? $post->published_at->translatedFormat('l, d F Y') : '-' }}</span>
                </div>

                <h1 class="heading-font fw-bold mb-3" style="color: var(--primary-green); font-size: 2.3rem; line-height: 1.25;">
                    {{ $post->title }}
                </h1>

                <div class="d-flex align-items-center justify-content-between pt-2 border-top border-light text-muted small">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-person-circle fs-5"></i>
                        <span>Oleh: <strong>{{ $post->user->name ?? 'Redaksi BEM STIKS' }}</strong></span>
                    </div>
                    <div>
                        <i class="bi bi-eye me-1"></i> {{ $post->views_count }} kali dibaca
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-5 section-warm">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="card-editorial p-4 p-md-5 bg-white">
                        <!-- Featured Image -->
                        @if($post->featured_image)
                            <div class="mb-4 rounded-3 overflow-hidden shadow-sm" style="max-height: 440px;">
                                <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" class="w-100 h-100 object-fit-cover">
                            </div>
                        @endif

                        <!-- Lead / Excerpt -->
                        @if($post->excerpt)
                            <div class="lead text-secondary fst-italic mb-4 p-3 bg-light rounded-3 border-start border-3 border-success">
                                {{ $post->excerpt }}
                            </div>
                        @endif

                        <!-- Main Content (HTML) -->
                        <div class="article-body leading-relaxed text-secondary" style="font-size: 1.08rem; line-height: 1.8;">
                            {!! $post->content !!}
                        </div>

                        <!-- Share Buttons -->
                        <div class="mt-5 pt-4 border-top border-light d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                            <span class="fw-bold small text-muted"><i class="bi bi-share-fill me-1 text-warning"></i> Bagikan publikasi ini:</span>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . url()->current()) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-whatsapp me-1"></i> WhatsApp
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-facebook me-1"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" target="_blank" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-twitter-x me-1"></i> X
                                </a>
                                <button onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan publikasi berhasil disalin!');" class="btn btn-sm btn-outline-secondary" title="Salin Tautan">
                                    <i class="bi bi-link-45deg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar (Related Posts & Categories) -->
                <div class="col-lg-4">
                    <!-- Related Posts -->
                    <div class="card-editorial p-4 bg-white mb-4">
                        <h6 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--primary-green);">Publikasi Terkait</h6>
                        <div class="d-flex flex-column gap-3">
                            @forelse($relatedPosts as $rel)
                                <div class="d-flex gap-3 align-items-start pb-2 border-bottom border-light">
                                    <img src="{{ asset($rel->featured_image ?? 'images/posts/post-1.jpg') }}" alt="{{ $rel->title }}" class="rounded object-fit-cover" width="65" height="50">
                                    <div>
                                        <a href="{{ route('posts.show', $rel->slug) }}" class="small fw-semibold text-dark text-decoration-none d-block line-clamp-2">
                                            {{ Str::limit($rel->title, 55) }}
                                        </a>
                                        <small class="text-muted" style="font-size: 0.75rem;">{{ $rel->published_at ? $rel->published_at->format('d M Y') : '' }}</small>
                                    </div>
                                </div>
                            @empty
                                <small class="text-muted">Belum ada artikel terkait lainnya.</small>
                            @endforelse
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="card-editorial p-4 bg-white">
                        <h6 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--primary-green);">Kategori Berita</h6>
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-2 small">
                            @foreach($categories as $c)
                                <li class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('posts.index', ['category' => $c->slug]) }}" class="text-decoration-none text-secondary">
                                        {{ $c->name }}
                                    </a>
                                    <span class="badge bg-light text-muted">{{ $c->posts_count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
