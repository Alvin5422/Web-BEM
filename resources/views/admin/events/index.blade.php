@extends('layouts.admin')

@section('title', 'Manajemen Agenda & Kalender - Panel Admin')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Manajemen Agenda & Kegiatan</h3>
            <p class="text-muted small mb-0">Kelola jadwal kegiatan, seminar, rapat kerja, dan aksi sosial mahasiswa.</p>
        </div>
        <a href="{{ route('admin.events.create') }}" class="btn btn-sm btn-primary-bem">
            <i class="bi bi-calendar-plus me-1"></i> Tambah Agenda
        </a>
    </div>

    <div class="card-editorial p-0 overflow-hidden bg-white shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small text-uppercase fw-bold text-muted">
                    <tr>
                        <th class="ps-4">Nama Agenda Kegiatan</th>
                        <th>Tanggal & Waktu</th>
                        <th>Lokasi</th>
                        <th>Program Terkait</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @forelse($events as $ev)
                        <tr>
                            <td class="ps-4">
                                <strong class="text-dark">{{ $ev->title }}</strong>
                                @if($ev->description)
                                    <small class="text-muted d-block text-truncate" style="max-width: 250px;">{{ $ev->description }}</small>
                                @endif
                            </td>
                            <td>
                                <div><i class="bi bi-calendar3 me-1 text-muted"></i> {{ $ev->event_date->format('d/m/Y') }}</div>
                                @if($ev->start_time)
                                    <small class="text-muted"><i class="bi bi-clock me-1"></i> {{ substr($ev->start_time, 0, 5) }} WITA</small>
                                @endif
                            </td>
                            <td><i class="bi bi-geo-alt text-danger me-1"></i> {{ $ev->location }}</td>
                            <td>{{ $ev->program->name ?? '-' }}</td>
                            <td>
                                @if($ev->status === 'mendatang')
                                    <span class="badge bg-success small"><i class="bi bi-clock me-1"></i> Mendatang</span>
                                @elseif($ev->status === 'berlangsung')
                                    <span class="badge bg-warning text-dark small"><i class="bi bi-play-circle me-1"></i> Berlangsung</span>
                                @else
                                    <span class="badge bg-secondary small"><i class="bi bi-check2 me-1"></i> Selesai</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.events.edit', $ev) }}" class="btn btn-sm btn-light border p-1 px-2" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.events.destroy', $ev) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus agenda kegiatan ini?')">
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
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada agenda yang dijadwalkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3 border-top d-flex justify-content-center">
            {{ $events->links() }}
        </div>
    </div>
@endsection
