@extends('layouts.admin')

@section('title', 'Pesan dari ' . $message->name . ' - Panel Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Pesan Masuk</h3>
            <p class="text-muted small mb-0">Diterima pada: {{ $message->created_at->format('l, d F Y - H:i') }} WITA</p>
        </div>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Kotak Masuk
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card-editorial p-4 bg-white mb-4">
                <div class="border-bottom pb-3 mb-3">
                    <h5 class="fw-bold text-dark mb-1">{{ $message->subject }}</h5>
                    <div class="small text-muted">
                        Dari: <strong>{{ $message->name }}</strong> &lt;{{ $message->email }}&gt;
                        @if($message->phone)
                            &bull; Telp/WA: <strong>{{ $message->phone }}</strong>
                        @endif
                    </div>
                </div>

                <div class="p-3 bg-light rounded-3 text-secondary leading-relaxed mb-4" style="white-space: pre-line; font-size: 1.05rem;">
                    {{ $message->message }}
                </div>

                <!-- Quick Action Buttons -->
                <div class="d-flex flex-wrap gap-2">
                    <a href="mailto:{{ $message->email }}?subject=Re: {{ urlencode($message->subject) }}" class="btn btn-sm btn-primary-bem">
                        <i class="bi bi-reply-fill me-1"></i> Balas Lewat Email
                    </a>
                    @if($message->phone)
                        @php
                            $cleanPhone = preg_replace('/[^0-9]/', '', $message->phone);
                            if (str_starts_with($cleanPhone, '0')) {
                                $cleanPhone = '62' . substr($cleanPhone, 1);
                            }
                        @endphp
                        <a href="https://wa.me/{{ $cleanPhone }}?text={{ urlencode('Halo ' . $message->name . ', kami dari pengurus BEM STIKS Tamalanrea Makassar menanggapi pesan Anda perihal "' . $message->subject . '"...') }}" target="_blank" class="btn btn-sm btn-outline-success">
                            <i class="bi bi-whatsapp me-1"></i> Balas Lewat WhatsApp
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-editorial p-4 bg-white">
                <h6 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--primary-green);">Catatan & Status Pesan</h6>
                <form action="{{ route('admin.messages.update-notes', $message) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="mark_replied" name="mark_replied" value="1" {{ $message->replied_at ? 'checked' : '' }}>
                        <label class="form-check-label small fw-semibold" for="mark_replied">
                            Tandai Sudah Dibalas
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Catatan Internal Pengurus</label>
                        <textarea name="admin_notes" rows="3" class="form-control form-control-sm" placeholder="Contoh: Sudah dikontak via WA oleh Humas...">{{ old('admin_notes', $message->admin_notes) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary-bem w-100">
                        <i class="bi bi-save me-1"></i> Simpan Catatan
                    </button>
                </form>

                <div class="mt-4 pt-3 border-top text-end">
                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash me-1"></i> Hapus Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
