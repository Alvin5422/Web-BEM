@extends('layouts.admin')

@section('title', 'Edit Pengurus BEM - Panel Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Edit Data Pengurus BEM</h3>
            <p class="text-muted small mb-0">Perbarui informasi fungsionaris kepengurusan.</p>
        </div>
        <a href="{{ route('admin.members.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card-editorial p-4 bg-white max-w-800">
        <form action="{{ route('admin.members.update', $member) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Pilih Periode / Kabinet <span class="text-danger">*</span></label>
                    <select name="period_id" class="form-select form-select-sm" required>
                        @foreach($periods as $p)
                            <option value="{{ $p->id }}" {{ $member->period_id == $p->id ? 'selected' : '' }}>
                                {{ $p->cabinet_name }} ({{ $p->name }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Bidang / Departemen <span class="text-danger">*</span></label>
                    <select name="department" class="form-select form-select-sm" required>
                        @foreach(['BPH Inti', 'Advokasi & Kesejahteraan Mahasiswa', 'Pengabdian Masyarakat & Aksi Sosial', 'Pengembangan Karakter & Kaderisasi', 'Komunikasi & Informasi', 'Minat Bakat & Penalaran'] as $dept)
                            <option value="{{ $dept }}" {{ $member->department === $dept ? 'selected' : '' }}>{{ $dept }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Nama Lengkap Pengurus <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control form-control-sm" value="{{ old('name', $member->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">NIM (Nomor Induk Mahasiswa)</label>
                    <input type="text" name="nim" class="form-control form-control-sm" value="{{ old('nim', $member->nim) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Jabatan Struktural <span class="text-danger">*</span></label>
                    <input type="text" name="role_title" class="form-control form-control-sm" value="{{ old('role_title', $member->role_title) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Urutan Tampil (Angka)</label>
                    <input type="number" name="order" class="form-control form-control-sm" value="{{ old('order', $member->order) }}">
                </div>
                <div class="col-12">
                    <label class="form-label small fw-semibold">Foto Pengurus</label>
                    <div class="d-flex align-items-center gap-3">
                        @if($member->photo)
                            <img src="{{ asset($member->photo) }}" alt="{{ $member->name }}" class="rounded object-fit-cover border" width="50" height="50">
                        @endif
                        <input type="file" name="photo" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-semibold">Bio / Deskripsi Singkat</label>
                    <textarea name="bio" rows="3" class="form-control form-control-sm">{{ old('bio', $member->bio) }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary-bem">
                <i class="bi bi-save me-1"></i> Perbarui Data Pengurus
            </button>
        </form>
    </div>
@endsection
