<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Panel Administrasi - BEM STIKS Tamalanrea</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v=2.0">
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 section-warm py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo/logo-bem.png') }}" alt="Logo BEM STIKS" height="75" class="mb-3">
                    <h4 class="fw-bold mb-1" style="color: var(--primary-green);">PANEL ADMINISTRASI</h4>
                    <p class="text-muted small">BEM STIKS Tamalanrea Makassar</p>
                </div>

                <div class="card-editorial p-4 p-md-5 bg-white shadow-sm">
                    @if(session('status'))
                        <div class="alert alert-info py-2 px-3 small mb-3">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger py-2 px-3 small mb-3">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('admin.login.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Email Pengelola</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="admin@stikstamalanrea.ac.id" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary-bem w-100 py-2">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk ke Panel
                        </button>
                    </form>

                    <div class="mt-4 pt-3 border-top text-center">
                        <a href="{{ route('home') }}" class="small text-decoration-none text-muted">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Website Utama
                        </a>
                    </div>
                </div>

                <div class="text-center mt-3 text-muted small">
                    &copy; {{ date('Y') }} BEM STIKS Tamalanrea Makassar
                </div>
            </div>
        </div>
    </div>
</body>
</html>
