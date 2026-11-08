@extends('layouts.admin')

@section('title', 'Dashboard Administrasi - BEM STIKS Tamalanrea')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Dashboard Administrasi</h3>
            <p class="text-muted small mb-0">Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong>. Berikut ringkasan aktivitas website resmi BEM STIKS Tamalanrea.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-primary-bem">
                <i class="bi bi-plus-lg me-1"></i> Tulis Berita
            </a>
            <a href="{{ route('admin.events.create') }}" class="btn btn-sm btn-outline-bem">
                <i class="bi bi-calendar-plus me-1"></i> Tambah Agenda
            </a>
        </div>
    </div>

    <!-- 4 Key Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card-editorial p-3 bg-white d-flex align-items-center justify-content-between">
                <div>
                    <small class="text-muted d-block fw-semibold">Total Publikasi</small>
                    <span class="fs-3 fw-bold" style="color: var(--primary-green);">{{ $stats['total_posts'] }}</span>
                    <small class="text-success d-block" style="font-size: 0.75rem;">{{ $stats['published_posts'] }} Terbit</small>
                </div>
                <div class="p-3 rounded-3" style="background-color: rgba(18, 63, 41, 0.08); color: var(--primary-green);">
                    <i class="bi bi-newspaper fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card-editorial p-3 bg-white d-flex align-items-center justify-content-between">
                <div>
                    <small class="text-muted d-block fw-semibold">Program Kerja</small>
                    <span class="fs-3 fw-bold" style="color: var(--primary-green);">{{ $stats['total_programs'] }}</span>
                    <small class="text-warning d-block" style="font-size: 0.75rem;">{{ $stats['active_programs'] }} Sedang Berjalan</small>
                </div>
                <div class="p-3 rounded-3" style="background-color: rgba(213, 174, 43, 0.15); color: #8C6E0C;">
                    <i class="bi bi-briefcase fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card-editorial p-3 bg-white d-flex align-items-center justify-content-between">
                <div>
                    <small class="text-muted d-block fw-semibold">Agenda Mendatang</small>
                    <span class="fs-3 fw-bold" style="color: var(--primary-green);">{{ $stats['upcoming_events'] }}</span>
                    <small class="text-muted d-block" style="font-size: 0.75rem;">Jadwal Kegiatan Terdekat</small>
                </div>
                <div class="p-3 rounded-3" style="background-color: rgba(13, 110, 253, 0.08); color: #0d6efd;">
                    <i class="bi bi-calendar-event fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card-editorial p-3 bg-white d-flex align-items-center justify-content-between">
                <div>
                    <small class="text-muted d-block fw-semibold">Aspirasi Belum Selesai</small>
                    <span class="fs-3 fw-bold text-danger">{{ $stats['unhandled_aspirations'] }}</span>
                    <small class="text-muted d-block" style="font-size: 0.75rem;">{{ $stats['unread_messages'] }} Pesan Kontak Baru</small>
                </div>
                <div class="p-3 rounded-3" style="background-color: rgba(220, 53, 69, 0.08); color: #dc3545;">
                    <i class="bi bi-megaphone fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Kabinet Banner -->
    @if($activePeriod)
        <div class="card-editorial p-3 bg-white mb-4 border-start border-4 border-success d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
            <div>
                <span class="badge-gold small mb-1">Kepengurusan Aktif</span>
                <h6 class="fw-bold mb-0 text-dark">{{ $activePeriod->cabinet_name }} &bull; Periode {{ $activePeriod->name }}</h6>
                <small class="text-muted">Ketua BEM: <strong>{{ $activePeriod->leader_name }}</strong> | Wakil: <strong>{{ $activePeriod->vice_leader_name ?? '-' }}</strong></small>
            </div>
            <a href="{{ route('admin.members.index', ['period_id' => $activePeriod->id]) }}" class="btn btn-sm btn-outline-bem">
                Kelola Pengurus <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    @endif

    <div class="row g-4">
        <!-- Col Left: Aspirasi & Pesan Perlu Ditangani -->
        <div class="col-lg-6">
            <div class="card-editorial p-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                    <h6 class="fw-bold mb-0" style="color: var(--primary-green);">
                        <i class="bi bi-megaphone-fill text-warning me-2"></i> Aspirasi Menunggu Tindak Lanjut
                    </h6>
                    <a href="{{ route('admin.aspirations.index') }}" class="small text-decoration-none fw-semibold">Lihat Semua</a>
                </div>

                <div class="d-flex flex-column gap-3">
                    @forelse($pendingAspirations as $asp)
                        <div class="p-3 bg-light rounded-3 d-flex justify-content-between align-items-start gap-2">
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <span class="font-monospace fw-bold small text-dark">{{ $asp->tracking_code }}</span>
                                    <span class="badge {{ $asp->status === 'menunggu' ? 'bg-secondary' : 'bg-warning text-dark' }}" style="font-size: 0.7rem;">
                                        {{ ucfirst($asp->status) }}
                                    </span>
                                </div>
                                <h6 class="small fw-semibold mb-1 text-dark">{{ Str::limit($asp->subject, 50) }}</h6>
                                <small class="text-muted d-block">{{ $asp->topic }} &bull; Dari: {{ $asp->is_anonymous ? 'Anonim' : ($asp->name ?? 'Mahasiswa') }}</small>
                            </div>
                            <a href="{{ route('admin.aspirations.show', $asp) }}" class="btn btn-sm btn-outline-bem text-nowrap">
                                Tanggapi
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-4 text-muted small">Semua aspirasi telah ditangani dengan baik.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Col Right: Publikasi & Agenda Terbaru -->
        <div class="col-lg-6">
            <div class="card-editorial p-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                    <h6 class="fw-bold mb-0" style="color: var(--primary-green);">
                        <i class="bi bi-newspaper text-warning me-2"></i> Publikasi & Berita Terbaru
                    </h6>
                    <a href="{{ route('admin.posts.index') }}" class="small text-decoration-none fw-semibold">Kelola Berita</a>
                </div>

                <div class="d-flex flex-column gap-3">
                    @forelse($recentPosts as $post)
                        <div class="p-2 border-bottom border-light d-flex justify-content-between align-items-center gap-2">
                            <div>
                                <h6 class="small fw-semibold mb-1 text-dark">{{ Str::limit($post->title, 48) }}</h6>
                                <div class="small text-muted" style="font-size: 0.75rem;">
                                    <span class="badge" style="background-color: {{ $post->category->color ?? '#123F29' }}; color: #FFF; font-size: 0.68rem;">{{ $post->category->name }}</span>
                                    &bull; {{ $post->published_at ? $post->published_at->format('d/m/Y') : 'Draf' }}
                                </div>
                            </div>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-light border" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-4 text-muted small">Belum ada publikasi yang dibuat.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
