@extends('layouts.app')

@section('title', 'Pusat Informasi - BEM STIKS Tamalanrea Makassar')

@section('content')
    <!-- Page Header -->
    <section class="py-5 bg-white border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb small mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-green);">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pusat Informasi</li>
                </ol>
            </nav>
            <div class="section-pretitle">Portal Layanan Terpadu</div>
            <h1 class="heading-font fw-bold mb-2" style="color: var(--primary-green); font-size: 2.3rem;">
                Pusat Informasi & Layanan BEM
            </h1>
            <p class="text-muted mb-0" style="font-size: 1.05rem;">
                Akses terpusat untuk program kerja, kalender kegiatan, linimasa kepengurusan, galeri dokumentasi, dan ruang aspirasi mahasiswa.
            </p>
        </div>
    </section>

    <!-- Interactive Navigation Tabs -->
    <div class="bg-light border-bottom sticky-subnav">
        <div class="container">
            <ul class="nav nav-tabs-editorial" id="infoTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $activeTab === 'proker' ? 'active' : '' }}" href="{{ route('information.index', ['tab' => 'proker']) }}">
                        <i class="bi bi-briefcase me-1 text-warning"></i> Program Kerja
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $activeTab === 'kalender' ? 'active' : '' }}" href="{{ route('information.index', ['tab' => 'kalender']) }}">
                        <i class="bi bi-calendar3 me-1 text-warning"></i> Kalender Kegiatan
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $activeTab === 'timeline' ? 'active' : '' }}" href="{{ route('information.index', ['tab' => 'timeline']) }}">
                        <i class="bi bi-clock-history me-1 text-warning"></i> Linimasa
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $activeTab === 'dokumentasi' ? 'active' : '' }}" href="{{ route('information.index', ['tab' => 'dokumentasi']) }}">
                        <i class="bi bi-images me-1 text-warning"></i> Dokumentasi
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $activeTab === 'aspirasi' ? 'active' : '' }}" href="{{ route('information.index', ['tab' => 'aspirasi']) }}">
                        <i class="bi bi-chat-heart me-1 text-warning"></i> Ruang Aspirasi
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Tab Content -->
    <section class="py-5 section-warm">
        <div class="container">

            {{-- 1. TAB PROGRAM KERJA --}}
            @if($activeTab === 'proker')
                <div class="mb-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 bg-white p-3 rounded-3 border">
                        <div class="fw-semibold text-secondary">
                            <i class="bi bi-funnel me-1 text-warning"></i> Filter Program Berdasarkan:
                        </div>
                        <form action="{{ route('information.index') }}" method="GET" class="d-flex flex-column flex-sm-row flex-wrap gap-2 w-100 w-md-auto">
                            <input type="hidden" name="tab" value="proker">
                            <select name="proker_dept" class="form-select form-select-sm w-100 w-sm-auto" onchange="this.form.submit()" style="min-width: 180px;">
                                <option value="all">Semua Bidang / Departemen</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept }}" {{ request('proker_dept') === $dept ? 'selected' : '' }}>{{ $dept }}</option>
                                @endforeach
                            </select>

                            <select name="proker_status" class="form-select form-select-sm w-100 w-sm-auto" onchange="this.form.submit()" style="min-width: 150px;">
                                <option value="all">Semua Status</option>
                                <option value="direncanakan" {{ request('proker_status') === 'direncanakan' ? 'selected' : '' }}>Direncanakan</option>
                                <option value="berjalan" {{ request('proker_status') === 'berjalan' ? 'selected' : '' }}>Sedang Berjalan</option>
                                <option value="selesai" {{ request('proker_status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            @if(request('proker_dept') || request('proker_status'))
                                <a href="{{ route('information.index', ['tab' => 'proker']) }}" class="btn btn-sm btn-outline-secondary w-100 w-sm-auto">Reset</a>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="row g-4">
                    @forelse($programs as $program)
                        <div class="col-lg-6">
                            <div class="card-editorial p-4 bg-white d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge-bem">{{ $program->department }}</span>
                                        @if($program->status === 'berjalan')
                                            <span class="badge bg-warning text-dark"><i class="bi bi-play-circle me-1"></i> Sedang Berjalan</span>
                                        @elseif($program->status === 'selesai')
                                            <span class="badge bg-success"><i class="bi bi-check2-all me-1"></i> Telah Selesai</span>
                                        @else
                                            <span class="badge bg-secondary"><i class="bi bi-clock me-1"></i> Direncanakan</span>
                                        @endif
                                    </div>
                                    <h5 class="fw-bold mb-2" style="color: var(--primary-green);">{{ $program->name }}</h5>
                                    <p class="text-secondary small leading-relaxed mb-3">
                                        {{ $program->description }}
                                    </p>
                                    @if($program->objective)
                                        <div class="p-2 bg-light rounded-2 small mb-3">
                                            <strong>Tujuan:</strong> {{ $program->objective }}
                                        </div>
                                    @endif
                                </div>
                                <div class="pt-3 border-top border-light d-flex flex-wrap justify-content-between align-items-center small text-muted">
                                    <span><i class="bi bi-people me-1"></i> Sasaran: {{ $program->target_audience ?? 'Civitas Akademika' }}</span>
                                    <span><i class="bi bi-person-badge me-1"></i> PJ: {{ $program->person_in_charge ?? 'BEM STIKS' }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5 text-muted">
                            Tidak ada program kerja yang cocok dengan filter yang dipilih.
                        </div>
                    @endforelse
                </div>

            {{-- 2. TAB KALENDER KEGIATAN --}}
            @elseif($activeTab === 'kalender')
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="card-editorial p-4 bg-white">
                            <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
                                <h5 class="fw-bold mb-0" style="color: var(--primary-green);">
                                    <i class="bi bi-calendar-week text-warning me-2"></i> Daftar Agenda & Kalender Kegiatan
                                </h5>
                                <span class="badge-gold small">{{ count($events) }} Kegiatan Terdaftar</span>
                            </div>

                            <div class="d-flex flex-column gap-3">
                                @forelse($events as $event)
                                    <div class="p-3 bg-light rounded-3 border-start border-4 {{ $event->status === 'selesai' ? 'border-secondary' : 'border-success' }} d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                                        <div>
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <span class="badge {{ $event->status === 'selesai' ? 'bg-secondary' : 'bg-success' }} small">
                                                    {{ ucfirst($event->status) }}
                                                </span>
                                                <span class="text-muted small">
                                                    <i class="bi bi-calendar-event me-1"></i> {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('l, d F Y') }}
                                                </span>
                                                @if($event->start_time)
                                                    <span class="text-muted small">&bull; {{ substr($event->start_time, 0, 5) }} WITA</span>
                                                @endif
                                            </div>
                                            <h6 class="fw-bold mb-1 text-dark">{{ $event->title }}</h6>
                                            <small class="text-muted"><i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $event->location }}</small>
                                            @if($event->description)
                                                <p class="text-secondary small mt-2 mb-0">{{ $event->description }}</p>
                                            @endif
                                        </div>
                                        @if($event->registration_link)
                                            <a href="{{ $event->registration_link }}" target="_blank" class="btn btn-sm btn-primary-bem text-nowrap">
                                                Daftar / Info <i class="bi bi-box-arrow-up-right ms-1"></i>
                                            </a>
                                        @endif
                                    </div>
                                @empty
                                    <div class="text-center py-4 text-muted">Belum ada agenda yang dijadwalkan.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card-editorial p-4 bg-white">
                            <h6 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--primary-green);">Catatan Agenda</h6>
                            <p class="text-muted small leading-relaxed">
                                Seluruh kegiatan yang tercantum dalam kalender telah diselaraskan dengan program kerja kabinet dan kalender akademik STIKS Tamalanrea Makassar.
                            </p>
                            <div class="p-3 bg-light rounded-3 small">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="badge bg-success rounded-circle p-1"> </span>
                                    <span>Kegiatan Mendatang / Terbuka</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-secondary rounded-circle p-1"> </span>
                                    <span>Kegiatan Telah Terlaksana</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            {{-- 3. TAB TIMELINE --}}
            @elseif($activeTab === 'timeline')
                <div class="max-w-800 mx-auto">
                    <div class="card-editorial p-4 p-md-5 bg-white">
                        <div class="mb-4 pb-2 border-bottom">
                            <h4 class="fw-bold mb-1" style="color: var(--primary-green);">Linimasa Perjalanan Kabinet</h4>
                            <p class="text-muted small mb-0">Roadmap tahapan pelaksanaan program kerja BEM STIKS Tamalanrea Makassar.</p>
                        </div>

                        <div class="timeline-stem">
                            @forelse($timelineEvents as $item)
                                <div class="timeline-item {{ $item->status === 'selesai' ? 'done' : '' }}">
                                    <div class="badge-gold small mb-1">
                                        {{ \Carbon\Carbon::parse($item->event_date)->translatedFormat('d F Y') }}
                                    </div>
                                    <h5 class="fw-bold mb-1 text-dark">{{ $item->title }}</h5>
                                    <div class="small text-muted mb-2">
                                        <i class="bi bi-geo-alt me-1"></i> {{ $item->location }} &bull;
                                        <span class="badge {{ $item->status === 'selesai' ? 'bg-success' : 'bg-warning text-dark' }} small">{{ ucfirst($item->status) }}</span>
                                    </div>
                                    @if($item->description)
                                        <p class="text-secondary small leading-relaxed mb-0">{{ $item->description }}</p>
                                    @endif
                                </div>
                            @empty
                                <div class="text-muted">Belum ada linimasa kegiatan.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

            {{-- 4. TAB DOKUMENTASI GALERI --}}
            @elseif($activeTab === 'dokumentasi')
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold mb-1" style="color: var(--primary-green);">Galeri Dokumentasi Kegiatan</h5>
                            <p class="text-muted small mb-0">Arsip visual kegiatan pengabdian, rapat kerja, dan aksi sosial mahasiswa.</p>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    @forelse($gallery as $med)
                        <div class="col-lg-4 col-md-6">
                            <div class="card-editorial p-2 bg-white overflow-hidden shadow-sm">
                                <div class="rounded-3 overflow-hidden position-relative" style="height: 230px;">
                                    <img src="{{ asset($med->file_path) }}" alt="{{ $med->title }}" class="w-100 h-100 object-fit-cover">
                                </div>
                                <div class="p-3">
                                    <span class="badge-gold small mb-1">{{ $med->category }}</span>
                                    <h6 class="fw-bold mb-1 text-dark text-truncate">{{ $med->title }}</h6>
                                    @if($med->caption)
                                        <p class="text-muted small mb-1" style="font-size: 0.8rem;">{{ Str::limit($med->caption, 80) }}</p>
                                    @endif
                                    <small class="text-muted" style="font-size: 0.75rem;"><i class="bi bi-calendar3 me-1"></i> {{ $med->taken_at ? \Carbon\Carbon::parse($med->taken_at)->format('d M Y') : '-' }}</small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5 text-muted">Belum ada galeri foto yang diunggah.</div>
                    @endforelse
                </div>

                <div class="d-flex justify-content-center mt-5">
                    {{ $gallery->links() }}
                </div>

            {{-- 5. TAB RUANG ASPIRASI --}}
            @elseif($activeTab === 'aspirasi')
                <div class="row g-5">
                    <!-- Form Aspirasi -->
                    <div class="col-lg-7">
                        <div class="card-editorial p-4 p-md-5 bg-white">
                            <div class="section-pretitle">Layanan Mahasiswa</div>
                            <h3 class="fw-bold mb-2" style="color: var(--primary-green);">Formulir Aspirasi Mahasiswa</h3>
                            <p class="text-muted small mb-4">
                                Sampaikan kritik, saran, permohonan advokasi, atau masukan untuk perbaikan kampus. Kerahasiaan data pribadi Anda terjamin.
                            </p>

                            @if(session('aspiration_success'))
                                <div class="alert alert-success p-4 rounded-3 border-0 shadow-sm mb-4">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <i class="bi bi-check-circle-fill fs-4 text-success"></i>
                                        <h6 class="fw-bold mb-0 text-success">Aspirasi Berhasil Terkirim!</h6>
                                    </div>
                                    <p class="small text-secondary mb-2">
                                        Terima kasih atas partisipasi Anda. Simpan kode tracking berikut untuk memeriksa status tindak lanjut pengurus BEM:
                                    </p>
                                    <div class="p-3 bg-white rounded-3 border border-success d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-dark fs-5 font-monospace">{{ session('tracking_code') }}</span>
                                        <a href="{{ route('aspirations.track', ['code' => session('tracking_code')]) }}" class="btn btn-sm btn-outline-success">
                                            Lacak Status <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <form action="{{ route('aspirations.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Anonymous toggle -->
                                <div class="form-check form-switch p-3 bg-light rounded-3 mb-3 border">
                                    <input class="form-check-input ms-0 me-2" type="checkbox" role="switch" id="is_anonymous" name="is_anonymous" value="1" onchange="toggleIdentity(this)">
                                    <label class="form-check-label fw-semibold small text-dark" for="is_anonymous">
                                        Kirim sebagai Anonim (Identitas Dirahasiakan)
                                    </label>
                                </div>

                                <div id="identityFields">
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-semibold">Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control form-control-sm" placeholder="Contoh: Muhammad Ilham" value="{{ old('name') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-semibold">NIM (Nomor Induk Mahasiswa)</label>
                                            <input type="text" name="nim" class="form-control form-control-sm" placeholder="Contoh: 23.01.045" value="{{ old('nim') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-semibold">Program Studi</label>
                                            <input type="text" name="study_program" class="form-control form-control-sm" placeholder="S1 Ilmu Kesejahteraan Sosial" value="{{ old('study_program', 'S1 Ilmu Kesejahteraan Sosial') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-semibold">Nomor WhatsApp</label>
                                            <input type="text" name="phone" class="form-control form-control-sm" placeholder="08xxxxxxxxxx" value="{{ old('phone') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-semibold">Kategori Topik Aspirasi <span class="text-danger">*</span></label>
                                    <select name="topic" class="form-select form-select-sm @error('topic') is-invalid @enderror" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="Akademik & Kurikulum" {{ old('topic') === 'Akademik & Kurikulum' ? 'selected' : '' }}>Akademik & Kurikulum</option>
                                        <option value="Fasilitas Kampus" {{ old('topic') === 'Fasilitas Kampus' ? 'selected' : '' }}>Fasilitas & Sarana Kampus</option>
                                        <option value="Kemahasiswaan & Organisasi" {{ old('topic') === 'Kemahasiswaan & Organisasi' ? 'selected' : '' }}>Kemahasiswaan & Organisasi</option>
                                        <option value="Advokasi UKT/Beasiswa" {{ old('topic') === 'Advokasi UKT/Beasiswa' ? 'selected' : '' }}>Advokasi UKT / Beasiswa</option>
                                        <option value="Birokrasi & Layanan" {{ old('topic') === 'Birokrasi & Layanan' ? 'selected' : '' }}>Birokrasi & Layanan Administrasi</option>
                                        <option value="Lainnya" {{ old('topic') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('topic') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-semibold">Subjek / Judul Aspirasi <span class="text-danger">*</span></label>
                                    <input type="text" name="subject" class="form-control form-control-sm @error('subject') is-invalid @enderror" placeholder="Ringkasan poin aspirasi..." value="{{ old('subject') }}" required>
                                    @error('subject') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-semibold">Uraian Lengkap Aspirasi <span class="text-danger">*</span></label>
                                    <textarea name="content" rows="5" class="form-control form-control-sm @error('content') is-invalid @enderror" placeholder="Jelaskan secara runtut persoalan atau gagasan yang ingin Anda sampaikan..." required>{{ old('content') }}</textarea>
                                    @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label small fw-semibold">Lampiran Bukti (Opsional - PDF, JPG, PNG maks 3MB)</label>
                                    <input type="file" name="attachment" class="form-control form-control-sm">
                                </div>

                                <button type="submit" class="btn btn-primary-bem w-100">
                                    <i class="bi bi-send-fill me-1"></i> Kirim Aspirasi
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Panel Lacak Aspirasi & Panduan -->
                    <div class="col-lg-5">
                        <div class="card-editorial p-4 bg-white mb-4">
                            <h5 class="fw-bold mb-2" style="color: var(--primary-green);">
                                <i class="bi bi-search text-warning me-2"></i> Lacak Status Aspirasi
                            </h5>
                            <p class="text-muted small mb-3">
                                Sudah pernah mengirimkan aspirasi? Masukkan kode tracking Anda di bawah untuk mengecek respon pengurus.
                            </p>
                            <form action="{{ route('aspirations.track') }}" method="GET">
                                <div class="input-group mb-2">
                                    <input type="text" name="code" class="form-control form-control-sm font-monospace" placeholder="Contoh: ASP-20261108-XXXX" required>
                                    <button class="btn btn-primary-bem btn-sm" type="submit">Cek Status</button>
                                </div>
                            </form>
                        </div>

                        <div class="card-editorial p-4 bg-white">
                            <h6 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--primary-green);">
                                <i class="bi bi-shield-lock-fill text-warning me-1"></i> Prinsip Penanganan Aspirasi
                            </h6>
                            <ul class="list-unstyled small text-muted d-flex flex-column gap-2 mb-0">
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-check2 text-success mt-1"></i>
                                    <span><strong>Transparan & Terukur:</strong> Setiap aspirasi diberikan tiket kode tracking untuk dipantau prosesnya.</span>
                                </li>
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-check2 text-success mt-1"></i>
                                    <span><strong>Privasi Terjaga:</strong> Isi aduan dan identitas pelapor tidak dipublikasikan secara terbuka untuk umum.</span>
                                </li>
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-check2 text-success mt-1"></i>
                                    <span><strong>Advokasi Langsung:</strong> Aspirasi diverifikasi oleh Departemen Advokasi BEM untuk diteruskan ke pimpinan kampus STIKS.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection

@push('scripts')
<script>
    function toggleIdentity(checkbox) {
        const fields = document.getElementById('identityFields');
        if (checkbox.checked) {
            fields.style.display = 'none';
        } else {
            fields.style.display = 'block';
        }
    }
</script>
@endpush
