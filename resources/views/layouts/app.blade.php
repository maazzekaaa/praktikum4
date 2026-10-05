<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Berita & Informasi - Desa Jalatrang')</title>

    <!-- FAVICON LOGO LOKAL -->
    <link rel="icon" type="image/png" href="{{ asset('storage/jalatrang.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        html { scroll-behavior: smooth; }
        body { 
            margin: 0; 
            padding: 0; 
            background-color: #f8f9fa; 
            font-family: 'Inter', sans-serif; 
            color: #333333; 
            overflow-x: clip; 
        }

        /* Top Info Bar & Marquee */
        .top-info-bar { 
            background-color: #0b1e36; 
            color: #ffffff; 
            font-size: 0.78rem; 
            padding: 6px 0; 
            border-bottom: 1px solid rgba(255, 255, 255, 0.1); 
        }
        .badge-info-terkini { 
            background-color: #e63946; 
            color: #ffffff; 
            font-size: 0.7rem; 
            font-weight: 700; 
            padding: 3px 8px; 
            border-radius: 3px; 
            text-transform: uppercase; 
        }
        .marquee-container { overflow: hidden; white-space: nowrap; width: 100%; }
        .marquee-text { 
            display: inline-block; 
            padding-left: 100%; 
            animation: marquee-anim 22s linear infinite; 
        }
        @keyframes marquee-anim { 
            0% { transform: translate(0, 0); } 
            100% { transform: translate(-100%, 0); } 
        }

        /* Sticky Header */
        .sticky-jalatrang-header { 
            position: sticky !important; 
            top: 0 !important; 
            z-index: 9999 !important; 
            background: linear-gradient(135deg, #0f2b48 0%, #08182b 100%) !important; 
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.25); 
            border-bottom: 3px solid #c88a2a; 
        }
        .header-brand-title { 
            font-size: 1.15rem; 
            font-weight: 800; 
            letter-spacing: 0.5px; 
            line-height: 1.2; 
            color: #ffffff; 
        }
        .header-brand-sub { font-size: 0.68rem; color: #9cb3c9; letter-spacing: 0.5px; }

        .nav-jalatrang { 
            background-color: rgba(255, 255, 255, 0.05); 
            border-radius: 8px; 
            padding: 4px 8px; 
            display: flex; 
            flex-wrap: wrap; 
        }
        .nav-jalatrang .nav-link { 
            color: #d0dfed !important; 
            font-size: 0.85rem; 
            font-weight: 500; 
            padding: 8px 14px !important; 
            border-radius: 6px; 
            transition: all 0.2s ease; 
        }
        .nav-jalatrang .nav-link.active, 
        .nav-jalatrang .nav-link:hover { 
            background-color: #c88a2a; 
            color: #ffffff !important; 
        }

        /* Banner Header Sub Page */
        .page-title-banner-sub { 
            background-color: #08182b; 
            padding: 24px 0; 
            color: #ffffff; 
            border-bottom: 1px solid #1a365d; 
        }
        .page-title-banner-sub h1 { font-size: 1.8rem; font-weight: 800; }

        /* ANIMASI CARD BERITA (SEPERTI WEB ASLI JALATRANG.ID) */
        .card-berita { 
            border: 1px solid #e2e8f0; 
            border-radius: 12px; 
            overflow: hidden; 
            background-color: #ffffff; 
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); 
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1); 
            position: relative;
        }

        /* Efek Terangkat & Bayangan saat Card Di-hover */
        .card-berita:hover { 
            transform: translateY(-6px); 
            box-shadow: 0 12px 24px -4px rgba(15, 43, 72, 0.15), 0 4px 8px -2px rgba(0, 0, 0, 0.05); 
            border-color: #cbd5e1;
        }

        /* Container Gambar untuk Zoom Effect */
        .card-berita-img-wrapper {
            overflow: hidden;
            position: relative;
            height: 200px;
            background-color: #f1f5f9;
        }

        /* Animasi Perbesaran Gambar (Zoom In) */
        .card-berita-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-berita:hover .card-berita-img-wrapper img {
            transform: scale(1.08);
        }

        /* Animasi Transisi Warna Judul */
        .card-berita-title {
            font-size: 1rem;
            font-weight: 700;
            color: #0f2b48;
            line-height: 1.4;
            transition: color 0.25s ease;
        }

        .card-berita:hover .card-berita-title {
            color: #0066ff;
        }

        /* Tombol Baca Selengkapnya dengan Mikro Animasi */
        .btn-baca-outline { 
            color: #0f2b48; 
            border: 1px solid #0f2b48; 
            font-weight: 600; 
            font-size: 0.78rem; 
            padding: 6px 14px; 
            border-radius: 6px; 
            text-decoration: none; 
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-baca-outline:hover { 
            background-color: #0f2b48; 
            color: #ffffff; 
            box-shadow: 0 4px 10px rgba(15, 43, 72, 0.25);
        }

        .btn-baca-outline i {
            transition: transform 0.25s ease;
        }

        .btn-baca-outline:hover i {
            transform: translateX(3px);
        }

        /* Footer */
        footer.footer-jalatrang { 
            background-color: #08182b; 
            color: #9cb3c9; 
            margin-top: 60px; 
            border-top: 4px solid #0f2b48; 
        }
        footer.footer-jalatrang a { color: #ffffff; text-decoration: none; }
    </style>
</head>
<body>

    <!-- STICKY HEADER -->
    <div class="sticky-jalatrang-header">
        <div class="top-info-bar">
            <div class="container-fluid px-4 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center flex-grow-1 overflow-hidden me-4">
                    <span class="badge-info-terkini me-2 flex-shrink-0">
                        INFO TERKINI
                    </span>
                    <div class="marquee-container flex-grow-1">
                        <div class="marquee-text">
                            Selamat Datang di Portal Berita dan Informasi Resmi Pemerintah Desa Jalatrang — Dapatkan update berita, kegiatan, dan pengumuman terbaru langsung dari desa kami.
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0 d-none d-md-block text-nowrap" style="color: #d0dfed;">
                    <i class="bi bi-clock me-1"></i> 
                    {{ date('l, d F Y') }}
                </div>
            </div>
        </div>

        <div class="container-fluid px-4 py-2">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('storage/jalatrang.png') }}" alt="Logo Desa Jalatrang" height="45" class="me-3">
                    <div>
                        <div class="header-brand-title">
                            PEMERINTAH DESA JALATRANG
                        </div>
                        <div class="header-brand-sub">
                            KECAMATAN CIPAKU KABUPATEN CIAMIS
                        </div>
                    </div>
                </div>

                <ul class="nav nav-jalatrang ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-house-door-fill me-1"></i> Profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Kependudukan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('berita.index') }}">
                            Berita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Potensi Wisata
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Download
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-wrapper">
        <div class="page-title-banner-sub">
            <div class="container">
                <div class="small text-uppercase mb-1" style="color: #9cb3c9;">
                    Beranda / Berita
                </div>
                <h1 class="mb-1">
                    Berita & Informasi
                </h1>
                <p class="mb-0" style="color: #9cb3c9;">
                    Informasi terkini dari Desa Jalatrang
                </p>
            </div>
        </div>

        <main class="container my-4">
            @yield('content')
        </main>
    </div>

    <!-- FOOTER -->
    <footer class="footer-jalatrang py-4">
        <div class="container text-center text-md-start">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 mb-2">
                        <img src="{{ asset('storage/jalatrang.png') }}" alt="Logo Desa Jalatrang" height="28">
                        <strong class="text-white fs-6">
                            Pemerintah Desa Jalatrang
                        </strong>
                    </div>
                    <small>
                        Kecamatan Cipaku, Kabupaten Ciamis, Jawa Barat
                    </small>
                    <br>
                    <small class="text-white-50">
                        &copy; {{ date('Y') }} Desa Jalatrang. All rights reserved.
                    </small>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('berita.index') }}">
                        <i class="bi bi-newspaper me-1"></i> Portal Berita Desa
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>