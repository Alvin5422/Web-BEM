<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Administrasi BEM STIKS Tamalanrea')</title>

    <!-- Google Fonts: Manrope & Source Sans 3 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&family=Source+Sans+3:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v=2.0">
    @stack('styles')
</head>
<body style="background-color: #F8FAFC;">

    <!-- Admin Sidebar -->
    <aside class="admin-sidebar shadow-sm">
        <!-- Sidebar Brand -->
        <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <img src="{{ asset($siteSettings['logo_bem'] ?? 'images/logo/logo-bem.png') }}" alt="Logo BEM" height="38">
                <div>
                    <h6 class="mb-0 fw-bold" style="color: var(--primary-green);">PANEL BEM</h6>
                    <small class="text-muted" style="font-size: 0.72rem;">STIKS Tamalanrea Makassar</small>
                </div>
            </div>
            <button class="btn btn-sm btn-light border d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminSidebarCollapse" aria-label="Tutup Menu">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div class="collapse d-lg-block" id="adminSidebarCollapse">
            <!-- Navigation Links -->
            <div class="py-2">
                <div class="admin-sidebar-heading">Ringkasan</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>

                <div class="admin-sidebar-heading">Kelembagaan</div>
                <a href="{{ route('admin.profile') }}" class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-person"></i> Profil BEM
                </a>
                <a href="{{ route('admin.periods.index') }}" class="nav-link {{ request()->routeIs('admin.periods.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-range"></i> Periode & Kabinet
                </a>
                <a href="{{ route('admin.members.index') }}" class="nav-link {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Susunan Pengurus
                </a>

                <div class="admin-sidebar-heading">Publikasi</div>
                <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                    <i class="bi bi-newspaper"></i> Berita & Artikel
                </a>
                <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i> Kategori Publikasi
                </a>

                <div class="admin-sidebar-heading">Kegiatan</div>
                <a href="{{ route('admin.programs.index') }}" class="nav-link {{ request()->routeIs('admin.programs.*') ? 'active' : '' }}">
                    <i class="bi bi-briefcase"></i> Program Kerja
                </a>
                <a href="{{ route('admin.events.index') }}" class="nav-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event"></i> Agenda & Kegiatan
                </a>
                <a href="{{ route('admin.media.index') }}" class="nav-link {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
                    <i class="bi bi-images"></i> Galeri Dokumentasi
                </a>

                <div class="admin-sidebar-heading">Layanan Mahasiswa</div>
                <a href="{{ route('admin.aspirations.index') }}" class="nav-link {{ request()->routeIs('admin.aspirations.*') ? 'active' : '' }}">
                    <i class="bi bi-megaphone"></i> Ruang Aspirasi
                </a>
                <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i> Kotak Masuk
                </a>

                @if(Auth::user()->isSuperAdmin())
                    <div class="admin-sidebar-heading">Sistem & Pengaturan</div>
                    <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                        <i class="bi bi-sliders"></i> Pengaturan Website
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="bi bi-person-gear"></i> Akun Pengelola
                    </a>
                @endif
            </div>

            <!-- Sidebar Footer -->
            <div class="p-3 border-top bg-light">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="fw-bold d-block text-dark">{{ Auth::user()->name }}</small>
                        <span class="badge {{ Auth::user()->isSuperAdmin() ? 'bg-danger' : 'bg-primary' }}" style="font-size: 0.65rem;">
                            {{ Auth::user()->role === 'super_admin' ? 'Super Admin' : 'Admin' }}
                        </span>
                    </div>
                    <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger p-1 px-2" title="Keluar">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="admin-main">
        <!-- Topbar Header -->
        <header class="bg-white border-bottom p-3 d-flex flex-wrap justify-content-between align-items-center sticky-top gap-2">
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-sm btn-outline-bem d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminSidebarCollapse" aria-expanded="false" aria-controls="adminSidebarCollapse">
                    <i class="bi bi-list"></i> Menu Panel
                </button>
                <span class="badge-gold">
                    <i class="bi bi-award-fill me-1"></i> {{ $siteSettings['cabinet_name'] ?? 'Kabinet Ananta Anardhaya' }} ({{ $siteSettings['active_period'] ?? '2026/2027' }})
                </span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-bem">
                    <i class="bi bi-globe me-1"></i> <span class="d-none d-sm-inline">Buka Website</span> Publik <i class="bi bi-box-arrow-up-right ms-1"></i>
                </a>
            </div>
        </header>

        <!-- Page Body -->
        <div class="p-3 p-md-4">
            <!-- Flash Message Alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show p-3 rounded-3 shadow-sm mb-4 border-0" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show p-3 rounded-3 shadow-sm mb-4 border-0" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show p-3 rounded-3 shadow-sm mb-4 border-0" role="alert">
                    <strong class="d-block mb-1"><i class="bi bi-exclamation-octagon me-1"></i> Mohon periksa kembali input formulir Anda:</strong>
                    <ul class="mb-0 small ps-3">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
