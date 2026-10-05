@extends('layouts.app')

@section('title', 'Tambah Berita Baru - Desa Jalatrang')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        
        <!-- ALERT ERROR JIKA VALIDASI GAGAL -->
        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm mb-4" role="alert">
                <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> Terjadi Kesalahan Input:</div>
                <ul class="mb-0 ps-3 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <!-- Card Header -->
            <div class="p-3 text-white d-flex justify-content-between align-items-center" style="background-color: #0f2b48;">
                <h5 class="fw-bold mb-0">
                    <i class="bi bi-plus-circle-fill me-2 text-warning"></i> Form Tambah Berita Baru
                </h5>
                <a href="{{ route('berita.index') }}" class="btn btn-outline-light btn-sm rounded-2">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <!-- Card Body Form -->
            <div class="card-body p-4 bg-white">
                <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- Wajib untuk keamanan CSRF -->

                    <!-- Input Judul -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">
                            Judul Berita <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="judul" 
                            class="form-control @error('judul') is-invalid @enderror" 
                            value="{{ old('judul') }}" 
                            placeholder="Masukkan judul berita desa..." 
                            required
                        >
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Row Kategori & Penulis -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark small">
                                Kategori Berita <span class="text-danger">*</span>
                            </label>
                            <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach (['Olahraga', 'Pendidikan', 'Potensi', 'Pembangunan'] as $k)
                                    <option value="{{ $k }}" @selected(old('kategori') == $k)>{{ $k }}</option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark small">
                                Penulis / Administrator
                            </label>
                            <input 
                                type="text" 
                                name="penulis" 
                                class="form-control bg-light" 
                                value="Admin" 
                                readonly
                            >
                        </div>
                    </div>

                    <!-- Input Gambar -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">
                            Gambar Sampul Berita <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="file" 
                            name="gambar" 
                            class="form-control @error('gambar') is-invalid @enderror" 
                            accept="image/*"
                            required
                        >
                        <div class="form-text text-muted" style="font-size: 0.75rem;">
                            Format gambar yang didukung: JPG, JPEG, PNG, WEBP (Maksimal 2MB).
                        </div>
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Isi Berita -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark small">
                            Isi Artikel Berita <span class="text-danger">*</span>
                        </label>
                        <textarea 
                            name="isi" 
                            rows="7" 
                            class="form-control @error('isi') is-invalid @enderror" 
                            placeholder="Tuliskan isi berita secara lengkap di sini..." 
                            required
                        >{{ old('isi') }}</textarea>
                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <button type="reset" class="btn btn-light border btn-sm px-3">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm px-4 fw-semibold" style="background-color: #0f2b48; border-color: #0f2b48;">
                            <i class="bi bi-send-fill me-1"></i> Terbitkan Berita
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection