@extends('layouts.app')

@section('title', 'Tentang BEM - STIKS Tamalanrea Makassar')

@section('content')
    <!-- Page Header -->
    <section class="py-5 bg-white border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb small mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-green);">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tentang BEM</li>
                </ol>
            </nav>
            <div class="section-pretitle">Profil Kelembagaan</div>
            <h1 class="heading-font fw-bold mb-2" style="color: var(--primary-green); font-size: 2.4rem;">
                Mengenal BEM STIKS Tamalanrea
            </h1>
            <p class="text-muted mb-0" style="font-size: 1.1rem; max-width: 750px;">
                Wadah pengembangan kepemimpinan, kreativitas, partisipasi, dan kepedulian sosial mahasiswa Sekolah Tinggi Ilmu Kesejahteraan Sosial Tamalanrea Makassar.
            </p>
        </div>
    </section>

    <!-- Sub-navigation links inside page -->
    <div class="bg-light border-bottom sticky-subnav">
        <div class="container">
            <div class="d-flex overflow-auto py-2 gap-2 text-nowrap">
                <a href="#profil" class="btn btn-sm btn-outline-bem">Profil Organisasi</a>
                <a href="#sejarah" class="btn btn-sm btn-outline-bem">Sejarah</a>
                <a href="#visimisi" class="btn btn-sm btn-outline-bem">Visi & Misi</a>
                <a href="#struktur" class="btn btn-sm btn-outline-bem">Struktur Pengurus</a>
                <a href="#filosofi" class="btn btn-sm btn-outline-bem">Filosofi Logo</a>
                <a href="#riwayat" class="btn btn-sm btn-outline-bem">Riwayat Kabinet</a>
            </div>
        </div>
    </div>

    <!-- 1. Profil BEM -->
    <section id="profil" class="py-5 section-white border-bottom">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="section-pretitle">Kedudukan & Peran</div>
                    <h2 class="section-title">Profil Badan Eksekutif Mahasiswa</h2>
                    <p class="text-muted leading-relaxed">
                        Badan Eksekutif Mahasiswa Sekolah Tinggi Ilmu Kesejahteraan Sosial (STIKS) Tamalanrea Makassar merupakan organisasi kemahasiswaan tertinggi di tingkat perguruan tinggi yang memegang mandat eksekutif mahasiswa.
                    </p>
                    <p class="text-muted leading-relaxed">
                        BEM berfungsi sebagai penggerak utama kegiatan mahasiswa, inisiator pengabdian kepada masyarakat, serta penyalur resmi aspirasi mahasiswa kepada pimpinan kampus dan lembaga eksternal. Berakar kuat pada disiplin ilmu kesejahteraan sosial, setiap dinamika kelembagaan selalu mengedepankan etika kemanusiaan, empati sosial, dan keadilan kolektif.
                    </p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 border-start border-3 border-success">
                                <h6 class="fw-bold mb-1" style="color: var(--primary-green);">Fokus Advokasi</h6>
                                <small class="text-muted">Mengawal hak belajar, fasilitas perkuliahan, dan keterbukaan beasiswa.</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 border-start border-3 border-warning">
                                <h6 class="fw-bold mb-1" style="color: var(--primary-green);">Fokus Pengabdian</h6>
                                <small class="text-muted">Aksi sosial nyata bagi komunitas pra-sejahtera dan kelompok rentan di Makassar.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 text-center">
                    <div class="p-4 bg-white rounded-4 shadow-sm border position-relative">
                        <img src="{{ asset($siteSettings['logo_bem'] ?? 'images/logo/logo-bem.png') }}" alt="Logo BEM STIKS" class="img-fluid" style="max-height: 280px; object-fit: contain;">
                        <div class="mt-3">
                            <h5 class="fw-bold mb-1" style="color: var(--primary-green);">{{ $siteSettings['site_name'] ?? 'BEM STIKS Tamalanrea Makassar' }}</h5>
                            <span class="badge-gold">{{ $siteSettings['tagline'] ?? 'Ruang Berkarya, Bergerak, dan Mengabdi' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Sejarah BEM -->
    <section id="sejarah" class="py-5 section-alt border-bottom">
        <div class="container">
            <div class="max-w-900 mx-auto">
                <div class="section-pretitle">Latar Belakang</div>
                <h2 class="section-title">Sejarah BEM STIKS Tamalanrea Makassar</h2>
                <div class="card-editorial p-4 p-md-5 bg-white">
                    <p class="text-secondary leading-relaxed mb-4">
                        {{ $siteSettings['sejarah'] ?? 'Badan Eksekutif Mahasiswa Sekolah Tinggi Ilmu Kesejahteraan Sosial (STIKS) Tamalanrea Makassar didirikan sebagai wadah kedaulatan mahasiswa dalam mengaktualisasikan Tri Dharma Perguruan Tinggi, khususnya di bidang pendidikan, penelitian, dan pengabdian masyarakat.' }}
                    </p>
                    <p class="text-secondary leading-relaxed mb-0">
                        Dalam perjalanannya, BEM STIKS Tamalanrea konsisten melahirkan calon pekerja sosial yang profesional, beretika, dan tanggap terhadap perubahan zaman. Melalui wadah ini, mahasiswa tidak hanya belajar teori di ruang kuliah, tetapi juga mempraktikkan keterampilan asesmen sosial, negosiasi advokasi, pengorganisasian massa, dan kepemimpinan adaptif.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Visi & Misi -->
    <section id="visimisi" class="py-5 section-white border-bottom">
        <div class="container">
            <div class="text-center max-w-700 mx-auto mb-5">
                <div class="section-pretitle justify-content-center">Landasan Perjuangan</div>
                <h2 class="section-title">Visi & Misi Kepengurusan Aktif</h2>
                <p class="text-muted">Arah strategis yang memandu seluruh gerak langkah organisasi pada periode berjalan.</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="card-editorial h-100 p-4 p-md-5" style="background-color: var(--primary-green); color: #FFFFFF;">
                        <span class="badge-gold mb-3 align-self-start">Visi Organisasi</span>
                        <h3 class="text-white fw-bold mb-4">Visi</h3>
                        <p class="text-white-50 leading-relaxed mb-0" style="font-size: 1.1rem;">
                            {{ $siteSettings['visi'] ?? 'Terwujudnya BEM STIKS Tamalanrea Makassar yang berintegritas, responsif, solutif, dan inklusif dalam mengawal kemajuan civitas akademika serta berdedikasi nyata bagi kesejahteraan sosial masyarakat.' }}
                        </p>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card-editorial h-100 p-4 p-md-5 bg-white">
                        <span class="badge-bem mb-3 align-self-start">Misi Strategis</span>
                        <h3 class="fw-bold mb-4" style="color: var(--primary-green);">Misi BEM</h3>
                        <div class="d-flex flex-column gap-3">
                            @php
                                $misiLines = explode("\n", $siteSettings['misi'] ?? '');
                            @endphp
                            @foreach($misiLines as $line)
                                @if(trim($line))
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 mt-1" style="width: 28px; height: 28px; background-color: rgba(18, 63, 41, 0.1); color: var(--primary-green);">
                                            <i class="bi bi-check-lg fw-bold"></i>
                                        </div>
                                        <span class="text-secondary leading-relaxed">{{ ltrim(trim($line), '0123456789. ') }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Struktur Kepengurusan -->
    <section id="struktur" class="py-5 section-alt border-bottom">
        <div class="container">
            <div class="text-center max-w-700 mx-auto mb-5">
                <div class="section-pretitle justify-content-center">Susunan Organisasi</div>
                <h2 class="section-title">Struktur Kepengurusan</h2>
                <p class="text-muted">
                    {{ $activePeriod ? $activePeriod->cabinet_name . ' (' . $activePeriod->name . ')' : 'Kabinet Aktif' }}
                </p>
            </div>

            @if(isset($departments) && count($departments) > 0)
                @foreach($departments as $deptName => $members)
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <h4 class="fw-bold mb-0 text-dark" style="font-family: var(--font-heading);">
                                <i class="bi bi-diagram-3 text-warning me-2"></i> {{ $deptName }}
                            </h4>
                            <div class="flex-grow-1 border-bottom"></div>
                        </div>

                        <div class="row g-4">
                            @foreach($members as $member)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="card-editorial p-3 text-center h-100 bg-white">
                                        <div class="mb-3 position-relative mx-auto" style="width: 130px; height: 130px;">
                                            <img src="{{ asset($member->photo ?? 'images/team/ketua-bem.jpg') }}" alt="{{ $member->name }}" class="w-100 h-100 rounded-circle object-fit-cover shadow-sm border border-2 border-light">
                                        </div>
                                        <h6 class="fw-bold mb-1 text-dark">{{ $member->name }}</h6>
                                        <div class="badge-gold small mb-2">{{ $member->role_title }}</div>
                                        @if($member->nim)
                                            <small class="text-muted d-block mb-1"><i class="bi bi-card-text me-1"></i> NIM: {{ $member->nim }}</small>
                                        @endif
                                        @if($member->bio)
                                            <p class="text-muted small mt-2 mb-0" style="font-size: 0.8rem;">
                                                {{ Str::limit($member->bio, 80) }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-4 text-muted">Belum ada data struktur pengurus yang diunggah.</div>
            @endif
        </div>
    </section>

    <!-- 5. Filosofi Logo -->
    <section id="filosofi" class="py-5 section-white border-bottom">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5 text-center">
                    <div class="p-4 bg-light rounded-4 border">
                        <img src="{{ asset($siteSettings['logo_bem'] ?? 'images/logo/logo-bem.png') }}" alt="Logo BEM STIKS" class="img-fluid mb-3" style="max-height: 290px; object-fit: contain;">
                        <h5 class="fw-bold mb-1" style="color: var(--primary-green);">Lambang Resmi BEM STIKS</h5>
                        <small class="text-muted">Sekolah Tinggi Ilmu Kesejahteraan Sosial Tamalanrea Makassar</small>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="section-pretitle">Makna & Lambang</div>
                    <h2 class="section-title">Filosofi Logo</h2>
                    <div class="card-editorial p-4 bg-white">
                        <div class="text-secondary leading-relaxed">
                            {!! nl2br(e($siteSettings['filosofi_logo'] ?? 'Lambang BEM STIKS Tamalanrea Makassar merepresentasikan perpaduan nilai akademik, kearifan lokal, dan komitmen kemanusiaan.')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Riwayat Kepengurusan / Arsip Kabinet -->
    <section id="riwayat" class="py-5 section-alt">
        <div class="container">
            <div class="text-center max-w-700 mx-auto mb-5">
                <div class="section-pretitle justify-content-center">Jejak Perjalanan</div>
                <h2 class="section-title">Riwayat Kepengurusan BEM</h2>
                <p class="text-muted">Arsip kepemimpinan kabinet BEM STIKS Tamalanrea Makassar dari masa ke masa.</p>
            </div>

            <div class="row g-4 justify-content-center">
                @if($activePeriod)
                    <div class="col-lg-4 col-md-6">
                        <div class="card-editorial p-4 border-2 border-success bg-white position-relative">
                            <span class="badge bg-success position-absolute top-0 end-0 m-3">Sedang Menjabat</span>
                            <span class="badge-gold mb-2">{{ $activePeriod->name }}</span>
                            <h5 class="fw-bold mb-1" style="color: var(--primary-green);">{{ $activePeriod->cabinet_name }}</h5>
                            <p class="text-muted small fst-italic mb-3">"{{ $activePeriod->motto ?? 'Abadi dalam Kebaikan' }}"</p>
                            <div class="small text-muted border-top pt-2">
                                <div><strong>Ketua:</strong> {{ $activePeriod->leader_name }}</div>
                                <div><strong>Wakil:</strong> {{ $activePeriod->vice_leader_name ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                @endif

                @foreach($pastPeriods as $past)
                    <div class="col-lg-4 col-md-6">
                        <div class="card-editorial p-4 bg-white opacity-90">
                            <span class="badge bg-secondary position-absolute top-0 end-0 m-3">Demisioner</span>
                            <span class="badge-bem mb-2">{{ $past->name }}</span>
                            <h5 class="fw-bold mb-1" style="color: var(--primary-green);">{{ $past->cabinet_name }}</h5>
                            <p class="text-muted small fst-italic mb-3">"{{ $past->motto ?? 'Dedikasi untuk Mahasiswa' }}"</p>
                            <div class="small text-muted border-top pt-2">
                                <div><strong>Ketua:</strong> {{ $past->leader_name }}</div>
                                <div><strong>Wakil:</strong> {{ $past->vice_leader_name ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
