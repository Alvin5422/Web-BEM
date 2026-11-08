@extends('layouts.admin')

@section('title', 'Tambah Pengurus BEM - Panel Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Tambah Data Pengurus BEM</h3>
            <p class="text-muted small mb-0">Masukkan data anggota fungsionaris kepengurusan BEM STIKS.</p>
        </div>
        <a href="{{ route('admin.members.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card-editorial p-4 bg-white max-w-800">
        <form action="{{ route('admin.members.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Pilih Periode / Kabinet <span class="text-danger">*</span></label>
                    <select name="period_id" class="form-select form-select-sm" required>
                        @foreach($periods as $p)
                            <option value="{{ $p->id }}" {{ $activePeriod && $activePeriod->id == $p->id ? 'selected' : '' }}>
                                {{ $p->cabinet_name }} ({{ $p->name }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Bidang / Departemen <span class="text-danger">*</span></label>
                    <select name="department" class="form-select form-select-sm" required>
                        <option value="BPH Inti">BPH Inti</option>
                        <option value="Advokasi & Kesejahteraan Mahasiswa">Advokasi & Kesejahteraan Mahasiswa</option>
                        <option value="Pengabdian Masyarakat & Aksi Sosial">Pengabdian Masyarakat & Aksi Sosial</option>
                        <option value="Pengembangan Karakter & Kaderisasi">Pengembangan Karakter & Kaderisasi</option>
                        <option value="Komunikasi & Informasi">Komunikasi & Informasi</option>
                        <option value="Minat Bakat & Penalaran">Minat Bakat & Penalaran</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Nama Lengkap Pengurus <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control form-control-sm" placeholder="Contoh: Ahmad Fauzan" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">NIM (Nomor Induk Mahasiswa)</label>
                    <input type="text" name="nim" class="form-control form-control-sm" placeholder="Contoh: 23.01.042" value="{{ old('nim') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Jabatan Struktural <span class="text-danger">*</span></label>
                    <input type="text" name="role_title" class="form-control form-control-sm" placeholder="Contoh: Ketua BEM / Sekretaris Umum / Kepala Bidang" value="{{ old('role_title') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Urutan Tampil (Angka)</label>
                    <input type="number" name="order" class="form-control form-control-sm" value="{{ old('order', 0) }}">
                </div>
                <div class="col-12">
                    <label class="form-label small fw-semibold">Foto Formal Pengurus</label>
                    <input type="file" name="photo" class="form-control form-control-sm">
                    <small class="text-muted" style="font-size: 0.75rem;">Format JPG/PNG rasio 1:1 atau 4:5, maks 2MB.</small>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-semibold">Bio / Deskripsi Singkat</label>
                    <textarea name="bio" rows="3" class="form-control form-control-sm" placeholder="Catatan singkat profil atau fokus kerja pengurus...">{{ old('bio') }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary-bem">
                <i class="bi bi-save me-1"></i> Simpan Pengurus
            </button>
        </form>
    </div>
@endsection
