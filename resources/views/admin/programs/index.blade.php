@extends('layouts.admin')

@section('title', 'Manajemen Program Kerja - Panel Admin')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Manajemen Program Kerja</h3>
            <p class="text-muted small mb-0">Kelola matrikulasi program kerja, status pelaksanaan, dan penanggung jawab.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.programs.create') }}" class="btn btn-sm btn-primary-bem">
                <i class="bi bi-plus-lg me-1"></i> Tambah Program Kerja
            </a>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="card-editorial p-3 bg-white mb-4">
        <form action="{{ route('admin.programs.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-5">
                <select name="period_id" class="form-select form-select-sm" onchange="this.form.submit()">
                    @foreach($periods as $p)
                        <option value="{{ $p->id }}" {{ $selectedPeriod && $selectedPeriod->id == $p->id ? 'selected' : '' }}>
                            {{ $p->cabinet_name }} ({{ $p->name }}) {{ $p->is_active ? '★ Aktif' : '' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Semua Status Pelaksanaan</option>
                    <option value="direncanakan" {{ request('status') === 'direncanakan' ? 'selected' : '' }}>Direncanakan</option>
                    <option value="berjalan" {{ request('status') === 'berjalan' ? 'selected' : '' }}>Sedang Berjalan</option>
                    <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div class="col-md-3">
                @if(request('status'))
                    <a href="{{ route('admin.programs.index') }}" class="btn btn-sm btn-outline-secondary w-100">Reset Filter</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table of Programs -->
    <div class="card-editorial p-0 overflow-hidden bg-white shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small text-uppercase fw-bold text-muted">
                    <tr>
                        <th class="ps-4">Nama Program</th>
                        <th>Departemen</th>
                        <th>Status</th>
                        <th>Penanggung Jawab</th>
                        <th>Unggulan Beranda</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @forelse($programs as $prog)
                        <tr>
                            <td class="ps-4">
                                <strong class="text-dark">{{ $prog->name }}</strong>
                                <small class="text-muted d-block text-truncate" style="max-width: 280px;">{{ $prog->description }}</small>
                            </td>
                            <td><span class="badge-bem small">{{ $prog->department }}</span></td>
                            <td>
                                @if($prog->status === 'berjalan')
                                    <span class="badge bg-warning text-dark small"><i class="bi bi-play-circle me-1"></i> Berjalan</span>
                                @elseif($prog->status === 'selesai')
                                    <span class="badge bg-success small"><i class="bi bi-check2 me-1"></i> Selesai</span>
                                @else
                                    <span class="badge bg-secondary small"><i class="bi bi-clock me-1"></i> Direncanakan</span>
                                @endif
                            </td>
                            <td>{{ $prog->person_in_charge ?? '-' }}</td>
                            <td>
                                @if($prog->is_featured)
                                    <span class="badge bg-success"><i class="bi bi-star-fill text-warning me-1"></i> Ya</span>
                                @else
                                    <span class="badge bg-light text-muted">Tidak</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.programs.edit', $prog) }}" class="btn btn-sm btn-light border p-1 px-2" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.programs.destroy', $prog) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus program kerja ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border text-danger p-1 px-2" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada program kerja yang terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3 border-top d-flex justify-content-center">
            {{ $programs->links() }}
        </div>
    </div>
@endsection
