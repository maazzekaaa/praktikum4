@extends('layouts.app')

@section('title', 'Berita & Informasi - Desa Jalatrang')

@section('content')
<div class="row">
    <!-- Sidebar Kiri (Filter & Kelola Berita) -->
    <div class="col-md-3 mb-4">
        
        <!-- KOTAK 1: FILTER BERITA -->
        <div class="filter-box mb-4 shadow-sm rounded-3 overflow-hidden border">
            <div class="filter-header text-white p-3 fw-bold" style="background-color: #0f2b48;">
                <i class="bi bi-funnel-fill me-1"></i> Filter Berita
            </div>
            <div class="filter-body p-3 bg-white">
                <form method="GET" action="{{ route('berita.index') }}">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-secondary">Kata Kunci</label>
                        <input type="text" name="kata_kunci" class="form-control form-control-sm"
                               value="{{ request('kata_kunci') }}" placeholder="Cari berita...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-secondary">Kategori</label>
                        <select name="kategori" class="form-select form-select-sm">
                            <option value="">Semua Kategori</option>
                            @foreach (['Olahraga', 'Pendidikan', 'Potensi', 'Pembangunan'] as $k)
                                <option value="{{ $k }}" @selected(request('kategori') == $k)>{{ $k }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100 fw-semibold mb-2" style="background-color: #2563eb; border-color: #2563eb;">
                        Cari
                    </button>
                    <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary btn-sm w-100 bg-white text-dark">
                        Reset
                    </a>
                </form>
            </div>
        </div>

        <!-- KOTAK 2: KELOLA BERITA (ROLE ADMIN TANPA BADGE MERAH) -->
        <div class="card border shadow-sm rounded-3 overflow-hidden">
            <div class="card-body p-3 bg-white">
                <h6 class="fw-bold text-dark mb-1">Kelola Berita</h6>
                <p class="text-muted small mb-3" style="font-size: 0.75rem; line-height: 1.3;">
                    Tambahkan artikel atau berita acara terbaru desa.
                </p>
                <a href="{{ route('berita.create') }}" class="btn text-white fw-semibold btn-sm w-100 py-2 d-flex align-items-center justify-content-center gap-1" style="background-color: #10b981; border: none; border-radius: 6px;">
                    <i class="bi bi-plus-lg"></i> + Buat Berita Baru
                </a>
            </div>
        </div>

    </div>

    <!-- Area Konten Utama Berita (Kanan) -->
    <div class="col-md-9">
        
        <!-- ALERT SUKSES HIJAU -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="background-color: #d1fae5; color: #065f46; font-size: 0.875rem;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.75rem;"></button>
            </div>
        @endif

        <div class="row g-4">
            @forelse ($beritas ?? [] as $berita)
                <div class="col-md-6 mb-2">
                    <div class="card card-berita h-100 border rounded-3 overflow-hidden bg-white shadow-sm">
                        
                        <!-- Wrapper Gambar Berita -->
                        <div class="card-berita-img-wrapper" style="height: 190px; overflow: hidden; position: relative;">
                            @php
                                $imgSrc = $berita->gambar 
                                    ? asset('storage/' . ltrim($berita->gambar, '/'))
                                    : 'https://placehold.co/400x220?text=Berita+Jalatrang';
                            @endphp

                            <img src="{{ $imgSrc }}"
                                 alt="{{ $berita->judul }}"
                                 class="w-100 h-100"
                                 style="object-fit: cover;"
                                 onerror="this.onerror=null; this.src='https://placehold.co/400x220?text=Berita+Jalatrang';">
                        </div>

                        <!-- Content Card -->
                        <div class="card-body d-flex flex-column p-3">
                            <!-- Kategori & Tanggal -->
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge bg-dark text-white px-2 py-1 rounded-1" style="font-size: 0.68rem; font-weight: 600;">
                                    {{ $berita->kategori }}
                                </span>
                                <small class="text-muted" style="font-size: 0.72rem;">
                                    <i class="bi bi-calendar3 me-1"></i>{{ $berita->created_at ? $berita->created_at->format('d M Y') : '28 Sep 2026' }}
                                </small>
                            </div>

                            <!-- Judul Berita -->
                            <h6 class="fw-bold mb-2 lh-sm">
                                <a href="{{ route('berita.show', $berita) }}" class="text-decoration-none text-dark card-berita-title" style="font-size: 0.925rem;">
                                    {{ Str::limit($berita->judul, 60) }}
                                </a>
                            </h6>

                            <!-- Deskripsi Singkat -->
                            <p class="text-secondary small flex-grow-1 mb-3" style="font-size: 0.78rem; line-height: 1.45;">
                                {{ Str::limit(strip_tags($berita->isi), 85) }}
                            </p>

                            <!-- Tag Pills Hashtag -->
                            <div class="mb-3">
                                <span class="tag-pill-grey text-muted me-1" style="font-size: 0.7rem; background-color: #f3f4f6; padding: 2px 6px; border-radius: 4px;">#desa</span>
                                <span class="tag-pill-grey text-muted me-1" style="font-size: 0.7rem; background-color: #f3f4f6; padding: 2px 6px; border-radius: 4px;">#jalatrang</span>
                                <span class="tag-pill-grey text-muted me-1" style="font-size: 0.7rem; background-color: #f3f4f6; padding: 2px 6px; border-radius: 4px;">#{{ Str::slug($berita->kategori) }}</span>
                            </div>

                            <!-- Tombol Aksi (Edit, Hapus, & Baca) -->
                            <div class="pt-2 border-top mt-auto d-flex justify-content-between align-items-center gap-1">
                                <div class="d-flex gap-1">
                                    <a href="{{ route('berita.edit', $berita) }}" class="btn btn-outline-warning btn-sm px-2 py-1" style="font-size: 0.75rem;">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('berita.destroy', $berita) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm px-2 py-1" style="font-size: 0.75rem;">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                                <a href="{{ route('berita.show', $berita) }}" class="btn btn-outline-primary btn-sm px-2 py-1" style="font-size: 0.75rem; border-color: #2563eb; color: #2563eb;">
                                    Baca <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center py-4 border-0 shadow-sm">
                        <i class="bi bi-info-circle me-1"></i> Tidak ada berita yang ditemukan.
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Paginasi Hasil -->
        @if (isset($beritas) && $beritas->total() > 0)
            <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-2">
                <small class="text-muted" style="font-size: 0.78rem;">
                    Menampilkan {{ $beritas->firstItem() }} - {{ $beritas->lastItem() }} dari {{ $beritas->total() }} hasil
                </small>
                <div>
                    {{ $beritas->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection