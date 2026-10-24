<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Berita & Informasi - Desa Jalatrang')</title>

    <link rel="icon" type="image/png" href="{{ asset('storage/berita/jalatrang.png') }}">

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

        .page-title-banner-sub { 
            background-color: #08182b; 
            padding: 24px 0; 
            color: #ffffff; 
            border-bottom: 1px solid #1a365d; 
        }
        .page-title-banner-sub h1 { font-size: 1.8rem; font-weight: 800; }

        .card-berita { 
            border: 1px solid #e2e8f0; 
            border-radius: 12px; 
            overflow: hidden; 
            background-color: #ffffff; 
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); 
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1); 
            position: relative;
        }

        .card-berita:hover { 
            transform: translateY(-6px); 
            box-shadow: 0 12px 24px -4px rgba(15, 43, 72, 0.15), 0 4px 8px -2px rgba(0, 0, 0, 0.05); 
            border-color: #cbd5e1;
        }

        .card-berita-img-wrapper {
            overflow: hidden;
            position: relative;
            height: 200px;
            background-color: #f1f5f9;
        }

        .card-berita-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-berita:hover .card-berita-img-wrapper img {
            transform: scale(1.08);
        }

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

        footer.footer-jalatrang { 
            background-color: #0b1d33; 
            color: #94a3b8; 
            margin-top: 60px; 
            border-top: 3px solid #0f2b48; 
            font-size: 0.85rem;
        }
        footer.footer-jalatrang a { 
            color: #94a3b8; 
            text-decoration: none; 
            transition: color 0.2s ease-in-out;
        }
        footer.footer-jalatrang a:hover { 
            color: #ffc107 !important;
        }
    </style>
</head>
<body>

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
                    {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>
        </div>

        <div class="container-fluid px-4 py-2">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <a href="{{ route('berita.index') }}" class="d-flex align-items-center text-decoration-none">
                    <img src="{{ asset('storage/berita/jalatrang.png') }}" alt="Logo Desa Jalatrang" height="45" class="me-3" onerror="this.onerror=null; this.src='https://placehold.co/45x45?text=Desa';">
                    <div>
                        <div class="header-brand-title">
                            PEMERINTAH DESA JALATRANG
                        </div>
                        <div class="header-brand-sub">
                            KECAMATAN CIPAKU KABUPATEN CIAMIS
                        </div>
                    </div>
                </a>

                <div class="ms-auto d-flex align-items-center gap-2">
                    <a href="{{ route('berita.index') }}" class="nav-link text-white d-inline-block active px-3 py-1">Berita</a>
                 
                    @auth
                        <span class="text-white small">
                            <i class="bi bi-person-circle"></i>
                            {{ auth()->user()->name }} ({{ auth()->user()->role }})
                        </span>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm btn-warning">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="main-wrapper">
        <div class="page-title-banner-sub">
            <div class="container">
                <div class="small text-uppercase mb-1" style="color: #9cb3c9;">
                    Beranda / Berita
                </div>
                <h1 class="mb-1">
                    @yield('title', 'Berita & Informasi')
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

    <footer class="footer-jalatrang pt-5 pb-4">
        <div class="container">
            <div class="row g-4 text-start">

                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('storage/berita/jalatrang.png') }}" alt="Logo Desa Jalatrang" height="42" class="me-2" onerror="this.onerror=null; this.src='https://placehold.co/42x42?text=Desa';">
                        <div>
                            <h6 class="fw-bold mb-0 text-white text-uppercase" style="letter-spacing: 0.5px;">Pemerintah Desa Jalatrang</h6>
                            <small class="d-block" style="font-size: 0.72rem; color: #94a3b8;">Kecamatan Cipaku, Kabupaten Ciamis</small>
                        </div>
                    </div>
                    <p class="mb-3 lh-sm" style="color: #94a3b8; font-size: 0.8rem;">
                        Portal resmi pelayanan publik dan media informasi terpadu masyarakat Desa Jalatrang. Mewujudkan tata kelola pemerintahan desa yang transparan, akuntabel, dan mandiri.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-color: #334155;"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-color: #334155;"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-color: #334155;"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-color: #334155;"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold text-white mb-3 pb-1 border-bottom d-inline-block" style="border-color: #334155 !important;">Navigasi</h6>
                    <ul class="list-unstyled mb-0 d-flex flex-column gap-2" style="font-size: 0.8rem;">
                        <li><a href="#"><i class="bi bi-chevron-right me-1 small"></i> Profil Desa</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-1 small"></i> Kependudukan</a></li>
                        <li><a href="{{ route('berita.index') }}"><i class="bi bi-chevron-right me-1 small"></i> Berita Desa</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-1 small"></i> Potensi Wisata</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-1 small"></i> Keuangan Desa</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold text-white mb-3 pb-1 border-bottom d-inline-block" style="border-color: #334155 !important;">Layanan Publik</h6>
                    <ul class="list-unstyled mb-0 d-flex flex-column gap-2" style="font-size: 0.8rem;">
                        <li><a href="#"><i class="bi bi-box-arrow-up-right me-1 small"></i> Warung Desa Online</a></li>
                        <li><a href="#"><i class="bi bi-box-arrow-up-right me-1 small"></i> Perpustakaan Selaras</a></li>
                        <li><a href="#"><i class="bi bi-box-arrow-up-right me-1 small"></i> IDM & SDGs Desa</a></li>
                        <li><a href="#"><i class="bi bi-box-arrow-up-right me-1 small"></i> Ketahanan Pangan</a></li>
                        <li><a href="#"><i class="bi bi-download me-1 small"></i> Download Dokumen</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold text-white mb-3 pb-1 border-bottom d-inline-block" style="border-color: #334155 !important;">Kontak Kantor</h6>
                    <ul class="list-unstyled mb-0 d-flex flex-column gap-2" style="color: #94a3b8; font-size: 0.8rem;">
                        <li class="d-flex gap-2">
                            <i class="bi bi-geo-alt-fill text-warning"></i>
                            <span>Jl. Raya Jalatrang No. 01, Kec. Cipaku, Kab. Ciamis, Jawa Barat 46252</span>
                        </li>
                        <li class="d-flex gap-2 align-items-center">
                            <i class="bi bi-telephone-fill text-warning"></i>
                            <span>(0265) 1234567</span>
                        </li>
                        <li class="d-flex gap-2 align-items-center">
                            <i class="bi bi-envelope-fill text-warning"></i>
                            <span>pemdes@jalatrang.id</span>
                        </li>
                        <li class="d-flex gap-2 align-items-center">
                            <i class="bi bi-clock-fill text-warning"></i>
                            <span>Senin - Jumat: 08.00 - 15.30 WIB</span>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="row mt-4 pt-3 border-top" style="border-color: #1e293b !important; font-size: 0.75rem;">
                <div class="col-md-6 text-center text-md-start mb-2 mb-md-0" style="color: #64748b;">
                    &copy; {{ date('Y') }} Pemerintah Desa Jalatrang. All rights reserved.
                </div>
                <div class="col-md-6 text-center text-md-end" style="color: #64748b;">
                    Dikembangkan untuk Portal Informasi Resmi Desa Jalatrang
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>