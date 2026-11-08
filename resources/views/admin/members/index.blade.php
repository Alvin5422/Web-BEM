@extends('layouts.admin')

@section('title', 'Susunan Pengurus BEM - Panel Admin')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Susunan Pengurus BEM</h3>
            <p class="text-muted small mb-0">Kelola daftar fungsionaris, bidang/departemen, dan jabatan struktural BEM STIKS.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <!-- Period filter dropdown -->
            <form action="{{ route('admin.members.index') }}" method="GET" class="d-inline">
                <select name="period_id" class="form-select form-select-sm" onchange="this.form.submit()">
                    @foreach($periods as $p)
                        <option value="{{ $p->id }}" {{ $selectedPeriod && $selectedPeriod->id == $p->id ? 'selected' : '' }}>
                            {{ $p->cabinet_name }} ({{ $p->name }}) {{ $p->is_active ? '★ Aktif' : '' }}
                        </option>
                    @endforeach
                </select>
            </form>
            <a href="{{ route('admin.members.create') }}" class="btn btn-sm btn-primary-bem text-nowrap">
                <i class="bi bi-person-plus me-1"></i> Tambah Pengurus
            </a>
        </div>
    </div>

    <div class="card-editorial p-0 overflow-hidden bg-white shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small text-uppercase fw-bold text-muted">
                    <tr>
                        <th class="ps-4">Foto & Nama</th>
                        <th>NIM</th>
                        <th>Jabatan</th>
                        <th>Bidang / Departemen</th>
                        <th>Urutan</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @forelse($members as $m)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset($m->photo ?? 'images/team/ketua-bem.jpg') }}" alt="{{ $m->name }}" class="rounded-circle object-fit-cover border" width="36" height="36">
                                    <div>
                                        <strong class="text-dark">{{ $m->name }}</strong>
                                        @if($m->bio)
                                            <small class="text-muted d-block text-truncate" style="max-width: 200px;">{{ $m->bio }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $m->nim ?? '-' }}</td>
                            <td><span class="badge-gold small">{{ $m->role_title }}</span></td>
                            <td><span class="badge-bem small">{{ $m->department }}</span></td>
                            <td>{{ $m->order }}</td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.members.edit', $m) }}" class="btn btn-sm btn-light border p-1 px-2" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.members.destroy', $m) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengurus ini?')">
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
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada pengurus untuk periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
