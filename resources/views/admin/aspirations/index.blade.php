@extends('layouts.admin')

@section('title', 'Ruang Aspirasi Mahasiswa - Panel Admin')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Ruang Aspirasi Mahasiswa</h3>
            <p class="text-muted small mb-0">Kelola masukan, kritik, dan permohonan advokasi dari civitas akademika.</p>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="card-editorial p-3 bg-white mb-4">
        <form action="{{ route('admin.aspirations.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari kode tracking / subjek / nama..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                    <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                    <option value="ditindaklanjuti" {{ request('status') === 'ditindaklanjuti' ? 'selected' : '' }}>Ditindaklanjuti</option>
                    <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai Ditangani</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="topic" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Semua Topik</option>
                    <option value="Akademik & Kurikulum" {{ request('topic') === 'Akademik & Kurikulum' ? 'selected' : '' }}>Akademik & Kurikulum</option>
                    <option value="Fasilitas Kampus" {{ request('topic') === 'Fasilitas Kampus' ? 'selected' : '' }}>Fasilitas Kampus</option>
                    <option value="Kemahasiswaan & Organisasi" {{ request('topic') === 'Kemahasiswaan & Organisasi' ? 'selected' : '' }}>Kemahasiswaan</option>
                    <option value="Advokasi UKT/Beasiswa" {{ request('topic') === 'Advokasi UKT/Beasiswa' ? 'selected' : '' }}>Advokasi UKT/Beasiswa</option>
                    <option value="Birokrasi & Layanan" {{ request('topic') === 'Birokrasi & Layanan' ? 'selected' : '' }}>Birokrasi</option>
                    <option value="Lainnya" {{ request('topic') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <div class="col-md-2">
                @if(request('search') || request('status') || request('topic'))
                    <a href="{{ route('admin.aspirations.index') }}" class="btn btn-sm btn-outline-secondary w-100">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="card-editorial p-0 overflow-hidden bg-white shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small text-uppercase fw-bold text-muted">
                    <tr>
                        <th class="ps-4">Kode Tiket</th>
                        <th>Pengirim</th>
                        <th>Topik & Subjek</th>
                        <th>Tanggal Masuk</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @forelse($aspirations as $asp)
                        <tr>
                            <td class="ps-4">
                                <span class="font-monospace fw-bold text-dark">{{ $asp->tracking_code }}</span>
                            </td>
                            <td>
                                @if($asp->is_anonymous)
                                    <span class="badge bg-light text-muted border"><i class="bi bi-incognito me-1"></i> Anonim</span>
                                @else
                                    <strong class="text-dark">{{ $asp->name }}</strong>
                                    @if($asp->nim)
                                        <small class="text-muted d-block">NIM: {{ $asp->nim }}</small>
                                    @endif
                                @endif
                            </td>
                            <td>
                                <span class="badge-gold small d-inline-block mb-1" style="font-size: 0.68rem;">{{ $asp->topic }}</span>
                                <div class="fw-semibold text-dark text-truncate" style="max-width: 280px;">{{ $asp->subject }}</div>
                            </td>
                            <td>{{ $asp->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($asp->status === 'menunggu')
                                    <span class="badge bg-secondary small">Menunggu</span>
                                @elseif($asp->status === 'diproses')
                                    <span class="badge bg-warning text-dark small">Diproses</span>
                                @elseif($asp->status === 'ditindaklanjuti')
                                    <span class="badge bg-primary small">Ditindaklanjuti</span>
                                @else
                                    <span class="badge bg-success small">Selesai</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.aspirations.show', $asp) }}" class="btn btn-sm btn-primary-bem py-1 px-3">
                                    Detail & Respon <i class="bi bi-chevron-right ms-1"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada aspirasi yang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3 border-top d-flex justify-content-center">
            {{ $aspirations->links() }}
        </div>
    </div>
@endsection
