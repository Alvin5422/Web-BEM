@extends('layouts.app')

@section('title', 'Beranda - BEM STIKS Tamalanrea Makassar')

@section('content')
    <!-- 1. Hero Section -->
    <section class="hero-editorial">
        <div class="container position-relative">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <div class="section-pretitle">Portal Resmi Organisasi Kemahasiswaan</div>
                    <h1 class="hero-tagline mb-3">
                        Ruang Berkarya, Bergerak, dan Mengabdi.
                    </h1>
                    <p class="hero-description">
                        BEM STIKS Tamalanrea Makassar hadir sebagai wadah aspirasi, kolaborasi, dan pengembangan potensi mahasiswa. Melalui kegiatan organisasi dan pengabdian masyarakat, kami berkomitmen menumbuhkan kepedulian sosial dan menghadirkan kontribusi nyata bagi lingkungan kampus serta masyarakat.
                    </p>
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <a href="{{ route('information.index', ['tab' => 'proker']) }}" class="btn btn-primary-bem">
                            <i class="bi bi-calendar2-check me-1"></i> Program Kerja
                        </a>
                        <a href="{{ route('about') }}" class="btn btn-outline-bem">
                            <i class="bi bi-compass me-1"></i> Profil Organisasi
                        </a>
                        <a href="{{ route('information.index', ['tab' => 'aspirasi']) }}" class="btn btn-gold-bem">
                            <i class="bi bi-megaphone me-1"></i> Ruang Aspirasi
                        </a>
                    </div>

                    <!-- Meta Badges -->
                    <div class="d-flex flex-wrap align-items-center gap-3 mt-4 pt-2 border-top border-secondary border-opacity-10">
                        <span class="badge-bem">
                            <i class="bi bi-shield-check text-success"></i> {{ $siteSettings['cabinet_name'] ?? 'Kabinet Ananta Anardhaya' }}
                        </span>
                        <span class="badge-bem">
                            <i class="bi bi-calendar3"></i> Periode {{ $siteSettings['active_period'] ?? '2026/2027' }}
                        </span>
                        <span class="badge-bem">
                            <i class="bi bi-people"></i> Ilmu Kesejahteraan Sosial
                        </span>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card-editorial p-4 shadow-sm border-0 position-relative bg-white">
                        <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ asset($siteSettings['logo_bem'] ?? 'images/logo/logo-bem.png') }}" alt="Logo BEM" height="38">
                                <div>
                                    <h6 class="mb-0 fw-bold" style="color: var(--primary-green);">BEM STIKS</h6>
                                    <small class="text-muted">Makassar, Sulawesi Selatan</small>
                                </div>
                            </div>
                            <span class="badge-gold">Resmi</span>
                        </div>
                        <div class="position-relative overflow-hidden rounded-3 mb-3" style="max-height: 280px;">
                            <img src="{{ asset('images/gallery/gallery-2.jpg') }}" alt="Kegiatan BEM STIKS" class="img-fluid w-100 object-fit-cover rounded-3">
                        </div>
                        <div class="p-2 bg-light rounded-3">
                            <div class="d-flex align-items-center justify-content-between small text-muted">
                                <span><i class="bi bi-heart-pulse-fill text-danger me-1"></i> Aksi Sosial & Advokasi</span>
                                <span class="fw-semibold text-dark">STIKS Tamalanrea</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Sambutan Ketua BEM -->
    <section class="py-5 section-white border-bottom">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-4 text-center">
                    <div class="position-relative d-inline-block">
                        <div class="p-2 bg-white rounded-4 shadow-sm border" style="max-width: 290px;">
                            <img src="{{ asset($siteSettings['sambutan_ketua_foto'] ?? 'images/team/ketua-bem.jpg') }}" alt="{{ $siteSettings['sambutan_ketua_nama'] ?? 'Ketua BEM' }}" class="img-fluid rounded-4 shadow-sm" style="width: 100%; aspect-ratio: 4/5; object-fit: cover;">
                            <div class="mt-3 text-start px-2 pb-1">
                                <h6 class="fw-bold mb-0 text-dark">{{ $siteSettings['sambutan_ketua_nama'] ?? 'Ahmad Fauzan Pratama' }}</h6>
                                <small class="text-muted">{{ $siteSettings['sambutan_ketua_periode'] ?? 'Ketua BEM Periode 2026/2027' }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="section-pretitle">Pesan Kepemimpinan</div>
                    <h2 class="section-title">Sambutan Ketua BEM STIKS</h2>
                    <blockquote class="border-start border-4 border-warning ps-3 my-3 text-secondary fst-italic">
                        "{{ $siteSettings['sambutan_ketua_text'] ?? 'Selamat datang di portal resmi BEM STIKS Tamalanrea Makassar. Wadah aspirasi, kolaborasi, dan karya nyata mahasiswa kesejahteraan sosial.' }}"
                    </blockquote>
                    <p class="text-muted">
                        Melalui portal ini, kami mengedepankan prinsip transparansi program, kemudahan penyampaian aspirasi mahasiswa, serta pertanggungjawaban publik atas seluruh agenda pengabdian yang dijalankan bersama.
                    </p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="{{ route('about') }}" class="btn btn-outline-bem btn-sm">
                            <i class="bi bi-people-fill me-1"></i> Struktur Kepengurusan
                        </a>
                        <a href="{{ route('contact.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-chat-dots me-1"></i> Hubungi Sekretariat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Visi & Misi Ringkas -->
    <section class="py-5 section-alt border-bottom">
        <div class="container">
            <div class="text-center max-w-700 mx-auto mb-5">
                <div class="section-pretitle justify-content-center">Arah Langkah Organisasi</div>
                <h2 class="section-title">Visi & Misi Kepengurusan</h2>
                <p class="section-subtitle mx-auto">
                    Komitmen kelembagaan BEM STIKS Tamalanrea Makassar dalam mewujudkan kampus yang aktif, inklusif, dan berorientasi pada kemaslahatan masyarakat.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="card-editorial h-100 p-4 border-0 shadow-sm" style="background-color: var(--primary-green); color: #FFFFFF;">
                        <span class="badge-gold mb-3 align-self-start">Visi Utama</span>
                        <h4 class="text-white fw-bold mb-3">Visi BEM STIKS</h4>
                        <p class="text-white-50 leading-relaxed mb-0">
                            {{ $siteSettings['visi'] ?? 'Terwujudnya BEM STIKS Tamalanrea Makassar yang berintegritas, responsif, solutif, dan inklusif dalam mengawal kemajuan civitas akademika serta berdedikasi nyata bagi kesejahteraan sosial masyarakat.' }}
                        </p>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card-editorial h-100 p-4 bg-white">
                        <span class="badge-bem mb-3 align-self-start">Misi Strategis</span>
                        <h4 class="fw-bold mb-3" style="color: var(--primary-green);">Pilar Misi</h4>
                        <div class="small text-muted d-flex flex-column gap-2">
                            @php
                                $misiLines = explode("\n", $siteSettings['misi'] ?? '');
                            @endphp
                            @foreach($misiLines as $line)
                                @if(trim($line))
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="bi bi-check-circle-fill text-success mt-1"></i>
                                        <span>{{ ltrim(trim($line), '0123456789. ') }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Program Kerja Unggulan -->
    <section class="py-5 section-white border-bottom">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
                <div>
                    <div class="section-pretitle">Rencana & Realisasi</div>
                    <h2 class="section-title mb-0">Program Kerja Unggulan</h2>
                </div>
                <a href="{{ route('information.index', ['tab' => 'proker']) }}" class="btn btn-outline-bem mt-3 mt-md-0">
                    Lihat Semua Program <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="row g-4">
                @forelse($featuredPrograms as $proker)
                    <div class="col-lg-4 col-md-6">
                        <div class="card-editorial d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge-bem small">{{ $proker->department }}</span>
                                    @if($proker->status === 'berjalan')
                                        <span class="badge bg-warning text-dark"><i class="bi bi-play-circle me-1"></i> Berjalan</span>
                                    @elseif($proker->status === 'selesai')
                                        <span class="badge bg-success"><i class="bi bi-check2-all me-1"></i> Selesai</span>
                                    @else
                                        <span class="badge bg-secondary"><i class="bi bi-clock me-1"></i> Direncanakan</span>
                                    @endif
                                </div>
                                <h5 class="fw-bold mb-2" style="color: var(--primary-green);">{{ $proker->name }}</h5>
                                <p class="text-muted small mb-3">
                                    {{ Str::limit($proker->description, 130) }}
                                </p>
                            </div>
                            <div class="pt-3 border-top border-light d-flex justify-content-between align-items-center small text-muted">
                                <span><i class="bi bi-person-badge me-1"></i> {{ $proker->person_in_charge ?? 'BEM STIKS' }}</span>
                                <a href="{{ route('information.index', ['tab' => 'proker']) }}" class="text-decoration-none fw-semibold" style="color: var(--primary-green);">
                                    Detail <i class="bi bi-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4 text-muted">Belum ada program kerja yang ditampilkan.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 5. Berita & Kegiatan Terbaru -->
    <section class="py-5 section-alt border-bottom">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
                <div>
                    <div class="section-pretitle">Warta & Publikasi</div>
                    <h2 class="section-title mb-0">Kabar Terbaru BEM</h2>
                </div>
                <a href="{{ route('posts.index') }}" class="btn btn-outline-bem mt-3 mt-md-0">
                    Arsip Publikasi <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="row g-4">
                @forelse($latestPosts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="card-editorial p-0 overflow-hidden d-flex flex-column justify-content-between">
                            <div>
                                <div class="position-relative" style="height: 200px; overflow: hidden;">
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
                                        <a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none text-dark hover-green">
                                            {{ Str::limit($post->title, 65) }}
                                        </a>
                                    </h5>
                                    <p class="text-muted small mb-0">
                                        {{ Str::limit($post->excerpt, 110) }}
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
                    <div class="col-12 text-center py-4 text-muted">Belum ada publikasi berita terbaru.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 6. Agenda Mendatang -->
    <section class="py-5 section-white border-bottom">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
                <div>
                    <div class="section-pretitle">Linimasa Waktu</div>
                    <h2 class="section-title mb-0">Agenda & Kegiatan Mendatang</h2>
                </div>
                <a href="{{ route('information.index', ['tab' => 'kalender']) }}" class="btn btn-outline-bem mt-3 mt-md-0">
                    Buka Kalender Lengkap <i class="bi bi-calendar3 ms-1"></i>
                </a>
            </div>

            <div class="row g-4">
                @forelse($upcomingEvents as $event)
                    <div class="col-lg-4 col-md-6">
                        <div class="card-editorial p-4 border-start border-4 border-success">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge-gold small">
                                    <i class="bi bi-calendar-event me-1"></i> {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}
                                </span>
                                @if($event->start_time)
                                    <small class="text-muted"><i class="bi bi-clock me-1"></i> {{ substr($event->start_time, 0, 5) }} WITA</small>
                                @endif
                            </div>
                            <h5 class="fw-bold mb-2" style="color: var(--primary-green);">{{ $event->title }}</h5>
                            <p class="text-muted small mb-3">
                                <i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $event->location }}
                            </p>
                            @if($event->description)
                                <p class="text-muted small mb-0">{{ Str::limit($event->description, 100) }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4 text-muted">Tidak ada agenda kegiatan terdekat saat ini.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 7. Dokumentasi Kegiatan -->
    <section class="py-5 section-alt border-bottom">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
                <div>
                    <div class="section-pretitle">Galeri Autentik</div>
                    <h2 class="section-title mb-0">Dokumentasi Kegiatan</h2>
                </div>
                <a href="{{ route('information.index', ['tab' => 'dokumentasi']) }}" class="btn btn-outline-bem mt-3 mt-md-0">
                    Lihat Semua Galeri <i class="bi bi-images ms-1"></i>
                </a>
            </div>

            <div class="row g-3">
                @forelse($gallery as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="card-editorial p-2 overflow-hidden position-relative group">
                            <div class="rounded-3 overflow-hidden position-relative" style="height: 220px;">
                                <img src="{{ asset($item->file_path) }}" alt="{{ $item->title }}" class="w-100 h-100 object-fit-cover">
                                <div class="position-absolute bottom-0 start-0 end-0 p-3 bg-dark bg-opacity-75 text-white">
                                    <div class="small fw-bold text-truncate">{{ $item->title }}</div>
                                    <small class="text-warning small">{{ $item->category }} &bull; {{ $item->taken_at ? \Carbon\Carbon::parse($item->taken_at)->format('d M Y') : '' }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4 text-muted">Belum ada dokumentasi kegiatan yang diunggah.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 8. Ruang Aspirasi Banner -->
    <section class="py-5" style="background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%); color: #FFFFFF;">
        <div class="container text-center py-3">
            <span class="badge-gold mb-3 d-inline-block">Partisipasi Mahasiswa</span>
            <h2 class="text-white fw-bold mb-3 display-6">Suara Mahasiswa, Bagian dari Perubahan.</h2>
            <p class="text-white-50 max-w-700 mx-auto mb-4" style="font-size: 1.1rem;">
                Sampaikan aspirasi, gagasan, dan masukan konstruktif untuk kemajuan kampus STIKS Tamalanrea Makassar. Identitas Anda terlindungi dan setiap aspirasi dapat dipantau perkembangannya secara transparan.
            </p>
            <div class="d-flex justify-content-center flex-wrap gap-3">
                <a href="{{ route('information.index', ['tab' => 'aspirasi']) }}" class="btn btn-gold-bem btn-lg px-4">
                    <i class="bi bi-chat-heart me-2"></i> Sampaikan Aspirasi Sekarang
                </a>
                <a href="{{ route('aspirations.track') }}" class="btn btn-outline-light btn-lg px-4">
                    <i class="bi bi-search me-2"></i> Cek Status Aspirasi Anda
                </a>
            </div>
        </div>
    </section>
@endsection
