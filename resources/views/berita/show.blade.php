@extends('layouts.app')

@section('title', $berita->judul . ' - Portal Resmi Desa Jalatrang')

@section('content')

<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb small bg-transparent p-0 mb-2">
        <li class="breadcrumb-item">
            <a href="{{ route('berita.index') }}" class="text-decoration-none text-muted">
                <i class="bi bi-house-door-fill"></i> Beranda
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('berita.index') }}" class="text-decoration-none text-muted">
                Berita
            </a>
        </li>
        <li class="breadcrumb-item active text-truncate" style="max-width: 250px;" aria-current="page">
            {{ $berita->judul }}
        </li>
    </ol>
</nav>

<div class="row g-4">

    <div class="col-lg-8">
        <article class="card border-0 shadow-sm rounded-3 p-4 bg-white">
            
            <span class="badge badge-kategori text-white mb-2" style="width: fit-content;">{{ $berita->kategori->nama ?? 'Umum' }}</span>

            <h2 class="mt-2 fw-bold text-dark">{{ $berita->judul }}</h2>

            <div class="mb-3">
                @foreach ($berita->tags as $tag)
                    <a href="{{ route('berita.index', ['tag' => $tag->id]) }}"
                       class="tag-pill text-decoration-none me-1">#{{ $tag->nama }}</a>
                @endforeach
            </div>

            <div class="d-flex flex-wrap align-items-center justify-content-between text-muted small py-2 my-2 border-top border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <span>
                        <i class="bi bi-person-circle me-1 text-primary"></i> 
                        <strong>{{ $berita->user->name }}</strong>
                    </span>
                    <span>
                        <i class="bi bi-calendar3 me-1"></i> 
                        {{ $berita->created_at ? $berita->created_at->format('d M Y, H:i') : date('d M Y, H:i') }} WIB
                    </span>
                </div>
                <div>
                    <span class="text-muted"><i class="bi bi-eye me-1"></i> {{ $berita->dilihat ?? 0 }} kali dilihat</span>
                </div>
            </div>

            <div class="my-3 text-center">
                <img 
                    src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://placehold.co/800x450?text=Portal+Berita+Desa+Jalatrang' }}" 
                    alt="{{ $berita->judul }}" 
                    class="img-fluid rounded-3 w-100 shadow-sm" 
                    style="max-height: 420px; object-fit: cover;"
                    onerror="this.onerror=null;this.src='https://placehold.co/800x450?text=Portal+Berita+Desa+Jalatrang';"
                >
                @if($berita->gambar)
                    <small class="text-muted d-block mt-2 fst-italic">
                        Dokumentasi Kegiatan Desa Jalatrang
                    </small>
                @endif
            </div>

            <div class="article-body lh-lg text-secondary fs-6 mt-3" style="text-align: justify; white-space: pre-line;">
                {!! e($berita->isi) !!}
            </div>

            <div class="mt-4 pt-3 border-top">
                <span class="fw-bold small text-dark me-2">
                    <i class="bi bi-tags-fill me-1"></i> Tag:
                </span>
                <a href="{{ route('berita.index', ['kategori' => $berita->kategori_id]) }}" class="badge bg-light text-secondary text-decoration-none border me-1">
                    #{{ Str::slug($berita->kategori->nama ?? 'umum') }}
                </a>
                <a href="{{ route('berita.index') }}" class="badge bg-light text-secondary text-decoration-none border me-1">
                    #desajalatrang
                </a>
            </div>

            <div class="mt-4 d-flex justify-content-between align-items-center">
                <a href="{{ route('berita.index') }}" class="btn btn-outline-primary btn-sm px-3 rounded-2" style="border-color: #0f2b48; color: #0f2b48;">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Berita
                </a>
            </div>

        </article>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white sticky-top" style="top: 90px; z-index: 10;">
            
            <div class="p-3 text-white fw-bold d-flex align-items-center justify-content-between" style="background-color: #0f2b48;">
                <span>
                    <i class="bi bi-newspaper me-2"></i> Berita Terkait
                </span>
                <small class="fw-normal">Terbaru</small>
            </div>

            <div class="card-body p-0">
                @forelse ($beritaTerkait ?? \App\Models\Berita::where('id', '!=', $berita->id)->latest()->take(4)->get() as $item)
                    <a href="{{ route('berita.show', $item) }}" class="text-decoration-none text-dark d-block border-bottom p-3 hover-sidebar-item">
                        <div class="row g-2 align-items-center">
                            <div class="col-4">
                                <img 
                                    src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://placehold.co/120x90?text=Jalatrang' }}" 
                                    alt="{{ $item->judul }}" 
                                    class="img-fluid rounded-2 w-100" 
                                    style="height: 65px; object-fit: cover;"
                                    onerror="this.onerror=null;this.src='https://placehold.co/120x90?text=Jalatrang';"
                                >
                            </div>
                            <div class="col-8">
                                <span class="badge bg-light text-primary border mb-1" style="font-size: 0.65rem; color: #0f2b48 !important;">
                                    {{ $item->kategori->nama ?? 'Umum' }}
                                </span>
                                <h6 class="fw-bold mb-1 text-dark lh-sm" style="font-size: 0.825rem;">
                                    {{ Str::limit($item->judul, 50) }}
                                </h6>
                                <small class="text-muted d-block" style="font-size: 0.7rem;">
                                    <i class="bi bi-calendar3 me-1"></i> 
                                    {{ $item->created_at ? $item->created_at->format('d M Y') : date('d M Y') }}
                                </small>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="p-3 text-muted small text-center">
                        Tidak ada berita terkait lainnya.
                    </div>
                @endforelse
            </div>

            <div class="p-3 bg-light text-center border-top">
                <a href="{{ route('berita.index') }}" class="text-decoration-none fw-semibold small" style="color: #0f2b48;">
                    Lihat Semua Berita Desa <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

        </div>
    </div>
</div>

<style>
    .hover-sidebar-item {
        transition: background-color 0.2s ease;
    }
    .hover-sidebar-item:hover {
        background-color: #f8f9fa;
    }
</style>
@endsection