@extends('layouts.admin')

@section('title', 'Manajemen Periode Kepengurusan - Panel Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Periode & Kabinet BEM</h3>
            <p class="text-muted small mb-0">Kelola riwayat kepengurusan kabinet BEM STIKS Tamalanrea Makassar.</p>
        </div>
        <a href="{{ route('admin.periods.create') }}" class="btn btn-sm btn-primary-bem">
            <i class="bi bi-plus-lg me-1"></i> Tambah Periode
        </a>
    </div>

    <div class="card-editorial p-0 overflow-hidden bg-white shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small text-uppercase fw-bold text-muted">
                    <tr>
                        <th class="ps-4">Periode</th>
                        <th>Nama Kabinet</th>
                        <th>Ketua & Wakil</th>
                        <th>Tahun</th>
                        <th>Jumlah Pengurus</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @forelse($periods as $period)
                        <tr>
                            <td class="ps-4 fw-bold text-dark">{{ $period->name }}</td>
                            <td>
                                <strong>{{ $period->cabinet_name }}</strong>
                                @if($period->motto)
                                    <small class="text-muted d-block fst-italic">"{{ $period->motto }}"</small>
                                @endif
                            </td>
                            <td>
                                <div>{{ $period->leader_name }}</div>
                                <small class="text-muted">{{ $period->vice_leader_name ?? '-' }}</small>
                            </td>
                            <td>{{ $period->start_year }} - {{ $period->end_year }}</td>
                            <td>
                                <a href="{{ route('admin.members.index', ['period_id' => $period->id]) }}" class="badge bg-light text-dark border text-decoration-none">
                                    <i class="bi bi-people me-1"></i> {{ $period->members_count }} Pengurus
                                </a>
                            </td>
                            <td>
                                @if($period->is_active)
                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Aktif Menjabat</span>
                                @else
                                    <form action="{{ route('admin.periods.toggle-active', $period) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-secondary py-0 px-2" style="font-size: 0.75rem;" onclick="return confirm('Aktifkan kabinet ini sebagai kepengurusan resmi?')">
                                            Aktifkan
                                        </button>
                                    </form>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.periods.edit', $period) }}" class="btn btn-sm btn-light border p-1 px-2" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if(!$period->is_active)
                                    <form action="{{ route('admin.periods.destroy', $period) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data periode ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light border text-danger p-1 px-2" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada periode kepengurusan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
