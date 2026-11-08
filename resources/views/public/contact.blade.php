@extends('layouts.app')

@section('title', 'Hubungi Kami - BEM STIKS Tamalanrea Makassar')

@section('content')
    <!-- Page Header -->
    <section class="py-5 bg-white border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb small mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-green);">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Hubungi Kami</li>
                </ol>
            </nav>
            <div class="section-pretitle">Saluran Komunikasi</div>
            <h1 class="heading-font fw-bold mb-2" style="color: var(--primary-green); font-size: 2.3rem;">
                Hubungi Sekretariat BEM
            </h1>
            <p class="text-muted mb-0" style="font-size: 1.05rem;">
                Silakan hubungi kami untuk kerja sama kegiatan, kemitraan pengabdian sosial, permohonan informasi resmi, atau kunjungan kelembagaan.
            </p>
        </div>
    </section>

    <section class="py-5 section-warm">
        <div class="container">
            @if(session('contact_success'))
                <div class="alert alert-success p-4 rounded-3 border-0 shadow-sm mb-4">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill fs-4"></i>
                        <div>
                            <h6 class="fw-bold mb-1">Pesan Berhasil Terkirim</h6>
                            <p class="mb-0 small">{{ session('contact_success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row g-5">
                <!-- Col 1: Contact Info & Maps -->
                <div class="col-lg-5">
                    <div class="card-editorial p-4 bg-white mb-4">
                        <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--primary-green);">
                            <i class="bi bi-building text-warning me-2"></i> Sekretariat Resmi BEM
                        </h5>

                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-start gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; background-color: rgba(18, 63, 41, 0.08); color: var(--primary-green);">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Alamat Kampus:</small>
                                    <span class="text-dark fw-semibold small">{{ $siteSettings['address'] ?? 'Jl. Perintis Kemerdekaan KM. 11, Tamalanrea, Makassar' }}</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-start gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; background-color: rgba(18, 63, 41, 0.08); color: var(--primary-green);">
                                    <i class="bi bi-envelope-fill"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Email Resmi:</small>
                                    <a href="mailto:{{ $siteSettings['email'] ?? 'bem@stikstamalanrea.ac.id' }}" class="text-dark fw-semibold small text-decoration-none">
                                        {{ $siteSettings['email'] ?? 'bem@stikstamalanrea.ac.id' }}
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex align-items-start gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; background-color: rgba(18, 63, 41, 0.08); color: var(--primary-green);">
                                    <i class="bi bi-whatsapp"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">WhatsApp Humas:</small>
                                    <span class="text-dark fw-semibold small">{{ $siteSettings['phone'] ?? '+62 821-9988-7766' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <small class="text-muted d-block mb-2">Media Sosial Resmi:</small>
                            <div class="d-flex flex-wrap gap-2">
                                @if(!empty($siteSettings['instagram']))
                                    <a href="{{ $siteSettings['instagram'] }}" target="_blank" class="btn btn-sm btn-outline-bem"><i class="bi bi-instagram me-1"></i> Instagram</a>
                                @endif
                                @if(!empty($siteSettings['youtube']))
                                    <a href="{{ $siteSettings['youtube'] }}" target="_blank" class="btn btn-sm btn-outline-danger"><i class="bi bi-youtube me-1"></i> YouTube</a>
                                @endif
                                @if(!empty($siteSettings['tiktok']))
                                    <a href="{{ $siteSettings['tiktok'] }}" target="_blank" class="btn btn-sm btn-outline-dark"><i class="bi bi-tiktok me-1"></i> TikTok</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Map Embed -->
                    <div class="card-editorial p-2 bg-white overflow-hidden shadow-sm" style="height: 280px;">
                        <iframe src="{{ $siteSettings['maps_embed_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.8396265737525!2d119.4939766!3d-5.1293798!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefd40c6b4aa3d%3A0xc36dbefcb2fa123!2sTamalanrea%2C%20Makassar!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid' }}" width="100%" height="100%" style="border:0; border-radius: 8px;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>

                <!-- Col 2: Message Form -->
                <div class="col-lg-7">
                    <div class="card-editorial p-4 p-md-5 bg-white">
                        <div class="section-pretitle">Kirim Pesan</div>
                        <h4 class="fw-bold mb-2" style="color: var(--primary-green);">Formulir Kontak Pengunjung</h4>
                        <p class="text-muted small mb-4">
                            Kirimkan surat atau pesan langsung ke kotak masuk pengurus BEM. Kami akan merespons melalui email atau WhatsApp.
                        </p>

                        <form action="{{ route('contact.send') }}" method="POST">
                            @csrf
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror" placeholder="Nama Anda..." value="{{ old('name') }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Alamat Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror" placeholder="nama@email.com" value="{{ old('email') }}" required>
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Nomor WhatsApp (Opsional)</label>
                                    <input type="text" name="phone" class="form-control form-control-sm" placeholder="08xxxxxxxxxx" value="{{ old('phone') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Subjek Pesan <span class="text-danger">*</span></label>
                                    <input type="text" name="subject" class="form-control form-control-sm @error('subject') is-invalid @enderror" placeholder="Contoh: Undangan Kemitraan Bakti Sosial" value="{{ old('subject') }}" required>
                                    @error('subject') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-semibold">Isi Pesan <span class="text-danger">*</span></label>
                                <textarea name="message" rows="5" class="form-control form-control-sm @error('message') is-invalid @enderror" placeholder="Tuliskan pesan atau maksud komunikasi Anda dengan jelas..." required>{{ old('message') }}</textarea>
                                @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary-bem w-100">
                                <i class="bi bi-send-fill me-1"></i> Kirim Pesan Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
