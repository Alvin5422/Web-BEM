<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BEM STIKS Tamalanrea Makassar - Portal Resmi Organisasi Kemahasiswaan')</title>
    <meta name="description" content="@yield('meta_description', 'Website Resmi Badan Eksekutif Mahasiswa Sekolah Tinggi Ilmu Kesejahteraan Sosial (STIKS) Tamalanrea Makassar. Ruang Berkarya, Bergerak, dan Mengabdi.')">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset($siteSettings['logo_bem'] ?? 'images/logo/logo-bem.png') }}">

    <!-- Google Fonts: Manrope & Source Sans 3 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&family=Source+Sans+3:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v=2.0">
    @stack('styles')
</head>
<body>

    <!-- Institutional Notification Bar -->
    <div class="top-institutional-bar d-none d-md-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <span><i class="bi bi-mortarboard-fill text-warning me-1"></i> {{ $siteSettings['campus_name'] ?? 'Sekolah Tinggi Ilmu Kesejahteraan Sosial Tamalanrea Makassar' }}</span>
                <span class="opacity-50">|</span>
                <span><i class="bi bi-geo-alt-fill text-warning me-1"></i> Makassar, Sulawesi Selatan</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('information.index', ['tab' => 'aspirasi']) }}" class="fw-semibold">
                    <i class="bi bi-megaphone-fill text-warning me-1"></i> Ruang Aspirasi
                </a>
                <span class="opacity-50">|</span>
                <a href="{{ route('contact.index') }}">
                    <i class="bi bi-envelope me-1"></i> Kontak
                </a>
                <span class="opacity-50">|</span>
                <a href="{{ route('admin.login') }}" class="opacity-75">
                    <i class="bi bi-lock-fill me-1"></i> Akses Pengurus
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-bem">
        <div class="container">
            <a class="brand-wrapper" href="{{ route('home') }}">
                <img src="{{ asset($siteSettings['logo_bem'] ?? 'images/logo/logo-bem.png') }}" alt="Logo BEM STIKS Tamalanrea" class="brand-logo-bem">
                <div class="d-flex flex-column">
                    <span class="brand-text-title">BEM STIKS</span>
                    <span class="brand-text-subtitle">Tamalanrea Makassar</span>
                </div>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 py-2 py-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang BEM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('posts.*') ? 'active' : '' }}" href="{{ route('posts.index') }}">Berita & Kegiatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('information.*') ? 'active' : '' }}" href="{{ route('information.index') }}">Pusat Informasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}" href="{{ route('contact.index') }}">Hubungi Kami</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2 pt-2 pt-lg-0">
                    <a href="{{ route('information.index', ['tab' => 'aspirasi']) }}" class="btn btn-primary-bem w-100 w-lg-auto">
                        <i class="bi bi-chat-heart me-1 text-warning"></i> Sampaikan Aspirasi
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Institutional Footer -->
    <footer class="footer-bem">
        <div class="container">
            <div class="row g-4">
                <!-- Col 1: Brand & Campus -->
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="{{ asset($siteSettings['logo_bem'] ?? 'images/logo/logo-bem.png') }}" alt="Logo BEM STIKS" height="52">
                        <img src="{{ asset($siteSettings['logo_campus'] ?? 'images/logo/logo-stiks.jpg') }}" alt="Logo Kampus STIKS" height="48" class="rounded bg-white p-1">
                        <div>
                            <h5 class="text-white mb-0 fw-bold">BEM STIKS</h5>
                            <small class="text-warning fw-semibold">Tamalanrea Makassar</small>
                        </div>
                    </div>
                    <p class="text-white-50 small pe-lg-3">
                        Badan Eksekutif Mahasiswa Sekolah Tinggi Ilmu Kesejahteraan Sosial (STIKS) Tamalanrea Makassar. Wadah aspirasi, kolaborasi, dan aktualisasi mahasiswa berorientasi pada pengabdian masyarakat serta kesejahteraan sosial.
                    </p>
                    <div class="d-flex gap-2 mt-3">
                        @if(!empty($siteSettings['instagram']))
                            <a href="{{ $siteSettings['instagram'] }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle px-2" title="Instagram"><i class="bi bi-instagram"></i></a>
                        @endif
                        @if(!empty($siteSettings['whatsapp']))
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteSettings['whatsapp']) }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle px-2" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                        @endif
                        @if(!empty($siteSettings['youtube']))
                            <a href="{{ $siteSettings['youtube'] }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle px-2" title="YouTube"><i class="bi bi-youtube"></i></a>
                        @endif
                        @if(!empty($siteSettings['tiktok']))
                            <a href="{{ $siteSettings['tiktok'] }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle px-2" title="TikTok"><i class="bi bi-tiktok"></i></a>
                        @endif
                    </div>
                </div>

                <!-- Col 2: Navigation -->
                <div class="col-lg-2 col-md-6">
                    <h6 class="text-white fw-bold mb-3 pb-1 border-bottom border-secondary border-opacity-25">Navigasi Utama</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
                        <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right me-1 text-warning"></i> Beranda</a></li>
                        <li><a href="{{ route('about') }}"><i class="bi bi-chevron-right me-1 text-warning"></i> Tentang BEM</a></li>
                        <li><a href="{{ route('posts.index') }}"><i class="bi bi-chevron-right me-1 text-warning"></i> Berita & Kegiatan</a></li>
                        <li><a href="{{ route('information.index') }}"><i class="bi bi-chevron-right me-1 text-warning"></i> Pusat Informasi</a></li>
                        <li><a href="{{ route('contact.index') }}"><i class="bi bi-chevron-right me-1 text-warning"></i> Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Col 3: Pusat Informasi Submenu -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="text-white fw-bold mb-3 pb-1 border-bottom border-secondary border-opacity-25">Pusat Informasi</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
                        <li><a href="{{ route('information.index', ['tab' => 'proker']) }}"><i class="bi bi-chevron-right me-1 text-warning"></i> Program Kerja Kabinet</a></li>
                        <li><a href="{{ route('information.index', ['tab' => 'kalender']) }}"><i class="bi bi-chevron-right me-1 text-warning"></i> Kalender Kegiatan</a></li>
                        <li><a href="{{ route('information.index', ['tab' => 'timeline']) }}"><i class="bi bi-chevron-right me-1 text-warning"></i> Linimasa Kepengurusan</a></li>
                        <li><a href="{{ route('information.index', ['tab' => 'dokumentasi']) }}"><i class="bi bi-chevron-right me-1 text-warning"></i> Galeri Dokumentasi</a></li>
                        <li><a href="{{ route('information.index', ['tab' => 'aspirasi']) }}"><i class="bi bi-chevron-right me-1 text-warning"></i> Ruang Aspirasi Mahasiswa</a></li>
                        <li><a href="{{ route('aspirations.track') }}"><i class="bi bi-search me-1 text-warning"></i> Lacak Status Aspirasi</a></li>
                    </ul>
                </div>

                <!-- Col 4: Secretariat & Contact -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="text-white fw-bold mb-3 pb-1 border-bottom border-secondary border-opacity-25">Sekretariat Resmi</h6>
                    <ul class="list-unstyled small text-white-50 d-flex flex-column gap-2 mb-0">
                        <li class="d-flex align-items-start gap-2">
                            <i class="bi bi-geo-alt text-warning mt-1"></i>
                            <span>{{ $siteSettings['address'] ?? 'Jl. Perintis Kemerdekaan KM. 11, Tamalanrea, Makassar' }}</span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <i class="bi bi-envelope text-warning"></i>
                            <a href="mailto:{{ $siteSettings['email'] ?? 'bem@stikstamalanrea.ac.id' }}">{{ $siteSettings['email'] ?? 'bem@stikstamalanrea.ac.id' }}</a>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <i class="bi bi-whatsapp text-warning"></i>
                            <span>{{ $siteSettings['phone'] ?? '+62 821-9988-7766' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Line -->
            <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <div>
                    &copy; {{ date('Y') }} <strong>BEM STIKS Tamalanrea Makassar</strong>. Seluruh Hak Cipta Dilindungi.
                </div>
                <div class="d-flex gap-3">
                    <span class="text-warning">{{ $siteSettings['cabinet_name'] ?? 'Kabinet Ananta Anardhaya' }} ({{ $siteSettings['active_period'] ?? '2026/2027' }})</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
