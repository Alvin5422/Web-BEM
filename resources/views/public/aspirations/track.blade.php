@extends('layouts.app')

@section('title', 'Lacak Status Aspirasi - BEM STIKS Tamalanrea Makassar')

@section('content')
    <section class="py-5 bg-white border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb small mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-green);">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('information.index', ['tab' => 'aspirasi']) }}" class="text-decoration-none" style="color: var(--primary-green);">Ruang Aspirasi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lacak Status</li>
                </ol>
            </nav>
            <div class="section-pretitle">Transparansi Layanan</div>
            <h1 class="heading-font fw-bold mb-2" style="color: var(--primary-green); font-size: 2.3rem;">
                Lacak Status Aspirasi
            </h1>
            <p class="text-muted mb-0" style="font-size: 1.05rem;">
                Pantau progres tindak lanjut aduan atau masukan yang telah Anda kirimkan kepada pengurus BEM STIKS.
            </p>
        </div>
    </section>

    <section class="py-5 section-warm">
        <div class="container">
            <div class="max-w-800 mx-auto">
                <!-- Search Box -->
                <div class="card-editorial p-4 bg-white mb-4">
                    <form action="{{ route('aspirations.track') }}" method="GET">
                        <label class="form-label small fw-bold text-dark">Masukkan Kode Tracking Aspirasi Anda:</label>
                        <div class="d-flex flex-column flex-sm-row gap-2">
                            <input type="text" name="code" class="form-control form-control-lg font-monospace text-uppercase" placeholder="Contoh: ASP-20261108-001" value="{{ $code ?? '' }}" required>
                            <button class="btn btn-primary-bem btn-lg text-nowrap" type="submit">
                                <i class="bi bi-search me-1"></i> Periksa Status
                            </button>
                        </div>
                    </form>
                </div>

                @if($error)
                    <div class="alert alert-danger p-4 rounded-3 border-0 shadow-sm">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Kode Tidak Ditemukan</h6>
                                <p class="mb-0 small">{{ $error }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if($aspiration)
                    <div class="card-editorial p-4 p-md-5 bg-white shadow-sm">
                        <div class="d-flex flex-wrap justify-content-between align-items-center pb-3 mb-4 border-bottom gap-2">
                            <div>
                                <small class="text-muted d-block">Nomor Registrasi Aspirasi:</small>
                                <span class="fs-4 fw-bold font-monospace text-dark">{{ $aspiration->tracking_code }}</span>
                            </div>
                            <div>
                                @if($aspiration->status === 'menunggu')
                                    <span class="badge bg-secondary fs-6"><i class="bi bi-clock me-1"></i> Menunggu Verifikasi</span>
                                @elseif($aspiration->status === 'diproses')
                                    <span class="badge bg-warning text-dark fs-6"><i class="bi bi-hourglass-split me-1"></i> Sedang Diproses</span>
                                @elseif($aspiration->status === 'ditindaklanjuti')
                                    <span class="badge bg-primary fs-6"><i class="bi bi-arrow-repeat me-1"></i> Ditindaklanjuti</span>
                                @elseif($aspiration->status === 'selesai')
                                    <span class="badge bg-success fs-6"><i class="bi bi-check2-circle me-1"></i> Selesai Ditangani</span>
                                @endif
                            </div>
                        </div>

                        <!-- Progress Bar Timeline -->
                        @php
                            $step = match($aspiration->status) {
                                'menunggu' => 1,
                                'diproses' => 2,
                                'ditindaklanjuti' => 3,
                                'selesai' => 4,
                                default => 1
                            };
                        @endphp
                        <div class="mb-5 px-md-3">
                            <div class="d-flex justify-content-between text-center small fw-semibold text-muted mb-2">
                                <span class="{{ $step >= 1 ? 'text-success fw-bold' : '' }}">1. Masuk</span>
                                <span class="{{ $step >= 2 ? 'text-success fw-bold' : '' }}">2. Diverifikasi</span>
                                <span class="{{ $step >= 3 ? 'text-success fw-bold' : '' }}">3. Ditindaklanjuti</span>
                                <span class="{{ $step >= 4 ? 'text-success fw-bold' : '' }}">4. Selesai</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($step / 4) * 100 }}%"></div>
                            </div>
                        </div>

                        <!-- Detail Information -->
                        <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                                <small class="text-muted d-block">Kategori Topik:</small>
                                <strong>{{ $aspiration->topic }}</strong>
                            </div>
                            <div class="col-sm-6">
                                <small class="text-muted d-block">Tanggal Pengiriman:</small>
                                <strong>{{ $aspiration->created_at->translatedFormat('d F Y, H:i') }} WITA</strong>
                            </div>
                            <div class="col-12">
                                <small class="text-muted d-block">Subjek Aspirasi:</small>
                                <strong>{{ $aspiration->subject }}</strong>
                            </div>
                        </div>

                        <!-- Official Response -->
                        <div class="p-4 rounded-3 border {{ $aspiration->response ? 'bg-light border-success' : 'bg-light' }}">
                            <h6 class="fw-bold mb-2" style="color: var(--primary-green);">
                                <i class="bi bi-reply-fill text-warning me-1"></i> Tanggapan Resmi Pengurus BEM:
                            </h6>
                            @if($aspiration->response)
                                <p class="text-secondary leading-relaxed mb-2">{{ $aspiration->response }}</p>
                                <small class="text-muted d-block border-top pt-2 mt-2">
                                    <i class="bi bi-clock-history me-1"></i> Ditanggapi pada: {{ $aspiration->responded_at ? $aspiration->responded_at->translatedFormat('d F Y, H:i') . ' WITA' : '-' }}
                                </small>
                            @else
                                <p class="text-muted fst-italic mb-0 small">
                                    Aspirasi Anda sedang dalam tahap penelaahan oleh tim kerja Departemen Advokasi BEM STIKS Tamalanrea Makassar. Tanggapan resmi akan diperbarui pada halaman ini segera setelah koordinasi dengan pihak terkait selesai.
                                </p>
                            @endif
                        </div>

                        <div class="mt-4 text-center">
                            <a href="{{ route('information.index', ['tab' => 'aspirasi']) }}" class="btn btn-outline-bem btn-sm">
                                <i class="bi bi-arrow-left me-1"></i> Kembali ke Ruang Aspirasi
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
