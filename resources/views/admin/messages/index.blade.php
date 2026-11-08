@extends('layouts.admin')

@section('title', 'Kotak Masuk Pesan - Panel Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Kotak Masuk Kontak</h3>
            <p class="text-muted small mb-0">Pesan dan permohonan kemitraan yang dikirimkan melalui formulir kontak publik.</p>
        </div>
    </div>

    <div class="card-editorial p-0 overflow-hidden bg-white shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small text-uppercase fw-bold text-muted">
                    <tr>
                        <th class="ps-4">Pengirim</th>
                        <th>Email & WhatsApp</th>
                        <th>Subjek Pesan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @forelse($messages as $msg)
                        <tr class="{{ !$msg->is_read ? 'table-warning bg-opacity-10 fw-bold' : '' }}">
                            <td class="ps-4">
                                <div class="text-dark">{{ $msg->name }}</div>
                            </td>
                            <td>
                                <div>{{ $msg->email }}</div>
                                @if($msg->phone)
                                    <small class="text-muted">{{ $msg->phone }}</small>
                                @endif
                            </td>
                            <td>
                                <div class="text-dark text-truncate" style="max-width: 280px;">{{ $msg->subject }}</div>
                                <small class="text-muted d-block text-truncate" style="max-width: 280px;">{{ $msg->message }}</small>
                            </td>
                            <td>{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if(!$msg->is_read)
                                    <span class="badge bg-danger">Baru</span>
                                @elseif($msg->replied_at)
                                    <span class="badge bg-success">Dibalas</span>
                                @else
                                    <span class="badge bg-light text-muted border">Dibaca</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-sm btn-primary-bem py-1 px-3">
                                    Buka Pesan <i class="bi bi-chevron-right ms-1"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Kotak masuk masih kosong.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3 border-top d-flex justify-content-center">
            {{ $messages->links() }}
        </div>
    </div>
@endsection
