@extends('layouts.admin')

@section('title', 'Galeri Dokumentasi - Panel Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Galeri Dokumentasi Kegiatan</h3>
            <p class="text-muted small mb-0">Kelola foto arsip kegiatan organisasi yang ditampilkan pada galeri publik.</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Upload Form -->
        <div class="col-lg-4">
            <div class="card-editorial p-4 bg-white">
                <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--primary-green);">
                    <i class="bi bi-cloud-arrow-up text-warning me-2"></i> Unggah Foto Baru
                </h5>

                <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Judul Foto / Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-sm" placeholder="Contoh: Pembukaan Rapat Pleno BEM" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Kategori Dokumentasi <span class="text-danger">*</span></label>
                        <select name="category" class="form-select form-select-sm" required>
                            <option value="Kegiatan">Kegiatan Umum</option>
                            <option value="Aksi Sosial">Aksi Sosial & Pengabdian</option>
                            <option value="Rapat Kerja">Rapat Kerja & Pleno</option>
                            <option value="Pelatihan">Pelatihan & Seminar</option>
                            <option value="Kemahasiswaan">Kemahasiswaan & Lomba</option>
                            <option value="Fasilitas">Fasilitas Kampus</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Terkait Agenda Kegiatan (Opsional)</label>
                        <select name="event_id" class="form-select form-select-sm">
                            <option value="">-- Tidak Terkait Agenda --</option>
                            @foreach($events as $ev)
                                <option value="{{ $ev->id }}">{{ $ev->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Tanggal Dokumentasi</label>
                        <input type="date" name="taken_at" class="form-control form-control-sm" value="{{ date('Y-m-d') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Berkas Foto <span class="text-danger">*</span></label>
                        <input type="file" name="file" class="form-control form-control-sm" required>
                        <small class="text-muted" style="font-size: 0.72rem;">JPG/PNG maks 4MB.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Keterangan / Caption</label>
                        <textarea name="caption" rows="2" class="form-control form-control-sm" placeholder="Catatan singkat foto..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary-bem w-100">
                        <i class="bi bi-upload me-1"></i> Unggah Dokumentasi
                    </button>
                </form>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="col-lg-8">
            <div class="card-editorial p-4 bg-white">
                <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--primary-green);">Daftar Foto Dokumentasi</h5>

                <div class="row g-3">
                    @forelse($media as $m)
                        <div class="col-sm-6 col-md-4">
                            <div class="border rounded-3 overflow-hidden position-relative group">
                                <div style="height: 140px; overflow: hidden;">
                                    <img src="{{ asset($m->file_path) }}" alt="{{ $m->title }}" class="w-100 h-100 object-fit-cover">
                                </div>
                                <div class="p-2 bg-light">
                                    <span class="badge-gold small d-inline-block mb-1" style="font-size: 0.65rem;">{{ $m->category }}</span>
                                    <div class="fw-semibold text-truncate small" title="{{ $m->title }}">{{ $m->title }}</div>
                                    <div class="d-flex justify-content-between align-items-center mt-2 pt-1 border-top border-secondary border-opacity-10">
                                        <small class="text-muted" style="font-size: 0.7rem;">{{ $m->taken_at ? $m->taken_at->format('d/m/Y') : '' }}</small>
                                        <form action="{{ route('admin.media.destroy', $m) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus foto ini dari galeri?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-link text-danger p-0 text-decoration-none" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5 text-muted">Belum ada foto dokumentasi diunggah.</div>
                    @endforelse
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $media->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
