<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Terjadi Kesalahan Server | BEM STIKS Tamalanrea</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 section-warm py-5">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <img src="{{ asset('images/logo/logo-bem.png') }}" alt="Logo BEM STIKS" height="70" class="mb-3">
                <div class="card-editorial p-4 p-md-5 bg-white shadow-sm">
                    <h1 class="display-3 fw-bold text-danger mb-2">500</h1>
                    <h4 class="fw-bold mb-3" style="color: var(--primary-green);">Terjadi Kesalahan Sistem</h4>
                    <p class="text-muted small mb-4">
                        Mohon maaf, server sedang mengalami kendala teknis. Tim administrator telah diberitahu dan sedang memperbaikinya.
                    </p>
                    <div class="d-flex justify-content-center">
                        <a href="{{ url('/') }}" class="btn btn-primary-bem px-4 py-2">
                            <i class="bi bi-house-door me-1"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
                <p class="text-muted small mt-3">&copy; {{ date('Y') }} BEM STIKS Tamalanrea Makassar</p>
            </div>
        </div>
    </div>
</body>
</html>

