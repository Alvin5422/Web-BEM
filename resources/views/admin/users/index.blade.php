@extends('layouts.admin')

@section('title', 'Manajemen Akun Pengelola - Panel Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Manajemen Akun Pengelola</h3>
            <p class="text-muted small mb-0">Kelola hak akses Super Admin dan Admin pengelola konten BEM STIKS.</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- User Table -->
        <div class="col-lg-7">
            <div class="card-editorial p-0 overflow-hidden bg-white shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small text-uppercase fw-bold text-muted">
                            <tr>
                                <th class="ps-4">Nama Pengelola</th>
                                <th>Email</th>
                                <th>Peran</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            @foreach($users as $user)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ $user->name }}</div>
                                        @if($user->phone)
                                            <small class="text-muted">{{ $user->phone }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge {{ $user->role === 'super_admin' ? 'bg-danger' : 'bg-primary' }}">
                                            {{ $user->role === 'super_admin' ? 'Super Admin' : 'Admin' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($user->is_active)
                                            <span class="badge bg-success small">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary small">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        @if($user->id !== Auth::id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus akun pengelola ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light border text-danger p-1 px-2" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge bg-light text-muted border">Akun Anda</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Create User Form -->
        <div class="col-lg-5">
            <div class="card-editorial p-4 bg-white">
                <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--primary-green);">
                    <i class="bi bi-person-plus text-warning me-2"></i> Tambah Akun Pengelola
                </h5>

                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-control-sm" placeholder="Contoh: Admin Humas" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Email Login <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control form-control-sm" placeholder="nama@stikstamalanrea.ac.id" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Kata Sandi Baru <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control form-control-sm" placeholder="Minimal 8 karakter" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Peran Akses <span class="text-danger">*</span></label>
                        <select name="role" class="form-select form-select-sm" required>
                            <option value="admin">Admin (Pengelola Konten & Layanan)</option>
                            <option value="super_admin">Super Admin (Akses Penuh Sistem)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nomor WhatsApp (Opsional)</label>
                        <input type="text" name="phone" class="form-control form-control-sm" placeholder="08xxxxxxxxxx">
                    </div>

                    <button type="submit" class="btn btn-primary-bem w-100">
                        <i class="bi bi-person-check me-1"></i> Buat Akun Pengelola
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
