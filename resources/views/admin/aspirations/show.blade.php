@extends('layouts.admin')

@section('title', 'Detail Aspirasi #' . $aspiration->tracking_code . ' - Panel Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Detail & Tindak Lanjut Aspirasi</h3>
            <p class="text-muted small mb-0">Tiket Registrasi: <span class="font-monospace fw-bold text-dark">{{ $aspiration->tracking_code }}</span></p>
        </div>
        <a href="{{ route('admin.aspirations.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row g-4">
        <!-- Col Left: Content & Reporter details -->
        <div class="col-lg-7">
            <div class="card-editorial p-4 bg-white mb-4">
                <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
                    <div>
                        <span class="badge-gold mb-1">{{ $aspiration->topic }}</span>
                        <h5 class="fw-bold text-dark mb-0">{{ $aspiration->subject }}</h5>
                    </div>
                    <span class="text-muted small">{{ $aspiration->created_at->format('d/m/Y H:i') }} WITA</span>
                </div>

                <div class="mb-4">
                    <label class="small text-muted fw-bold d-block mb-1">Uraian Aspirasi:</label>
                    <div class="p-3 bg-light rounded-3 text-secondary leading-relaxed" style="white-space: pre-line;">
                        {{ $aspiration->content }}
                    </div>
                </div>

                @if($aspiration->attachment)
                    <div class="mb-4">
                        <label class="small text-muted fw-bold d-block mb-1">Lampiran Berkas:</label>
                        <a href="{{ asset('storage/' . $aspiration->attachment) }}" target="_blank" class="btn btn-sm btn-outline-bem">
                            <i class="bi bi-paperclip me-1"></i> Buka Lampiran Berkas <i class="bi bi-box-arrow-up-right ms-1"></i>
                        </a>
                    </div>
                @endif

                <div class="border-top pt-3">
                    <h6 class="fw-bold mb-2 text-dark">Data Pengirim</h6>
                    @if($aspiration->is_anonymous)
                        <div class="alert alert-secondary py-2 px-3 small mb-0">
                            <i class="bi bi-incognito me-1"></i> Dikirimkan dengan status <strong>Anonim</strong> (Data identitas dirahasiakan oleh mahasiswa).
                        </div>
                    @else
                        <div class="row g-2 small text-muted">
                            <div class="col-sm-6">Nama: <strong class="text-dark">{{ $aspiration->name }}</strong></div>
                            <div class="col-sm-6">NIM: <strong class="text-dark">{{ $aspiration->nim ?? '-' }}</strong></div>
                            <div class="col-sm-6">Prodi: <strong class="text-dark">{{ $aspiration->study_program ?? '-' }}</strong></div>
                            <div class="col-sm-6">Kontak WhatsApp: <strong class="text-dark">{{ $aspiration->phone ?? '-' }}</strong></div>
                            <div class="col-12">Email: <strong class="text-dark">{{ $aspiration->email ?? '-' }}</strong></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Col Right: Status Management & Official Response -->
        <div class="col-lg-5">
            <div class="card-editorial p-4 bg-white mb-4">
                <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--primary-green);">
                    <i class="bi bi-arrow-repeat text-warning me-2"></i> Update Status & Respon
                </h5>

                <form action="{{ route('admin.aspirations.update-status', $aspiration) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Status Penanganan <span class="text-danger">*</span></label>
                        <select name="status" class="form-select form-select-sm" required>
                            <option value="menunggu" {{ $aspiration->status === 'menunggu' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                            <option value="diproses" {{ $aspiration->status === 'diproses' ? 'selected' : '' }}>Sedang Diproses Internal</option>
                            <option value="ditindaklanjuti" {{ $aspiration->status === 'ditindaklanjuti' ? 'selected' : '' }}>Ditindaklanjuti ke Pihak Kampus</option>
                            <option value="selesai" {{ $aspiration->status === 'selesai' ? 'selected' : '' }}>Selesai Ditangani</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Tanggapan Resmi (Dilihat Mahasiswa via Kode Tracking)</label>
                        <textarea name="response" rows="4" class="form-control form-control-sm" placeholder="Tuliskan respon resmi tindak lanjut BEM untuk pelapor...">{{ old('response', $aspiration->response) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-semibold">Catatan Internal Admin (Hanya Pengurus)</label>
                        <textarea name="admin_notes" rows="3" class="form-control form-control-sm" placeholder="Catatan internal pengurus (misal: sudah dikoordinasikan dengan Wadek III)...">{{ old('admin_notes', $aspiration->admin_notes) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary-bem w-100">
                        <i class="bi bi-save me-1"></i> Perbarui Status & Simpan Respon
                    </button>
                </form>

                <div class="mt-4 pt-3 border-top text-end">
                    <form action="{{ route('admin.aspirations.destroy', $aspiration) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data aspirasi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash me-1"></i> Hapus Aspirasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
