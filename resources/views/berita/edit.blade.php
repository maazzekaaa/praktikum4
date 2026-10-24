@extends('layouts.app')

@section('title', 'Edit Berita - Desa Jalatrang')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="p-3 text-white fw-bold d-flex align-items-center justify-content-between" style="background-color: #0f2b48;">
                <span><i class="bi bi-pencil-square me-2"></i> Edit Berita</span>
                <a href="{{ route('berita.index') }}" class="btn btn-outline-light btn-sm rounded-2">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
            <div class="card-body p-4 bg-white">
                <form action="{{ route('berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="judul" class="form-label fw-semibold">Judul Berita</label>
                        <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul', $berita->judul) }}" required>
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kategori_id" class="form-label fw-semibold">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                            @foreach ($kategoris as $k)
                                <option value="{{ $k->id }}" @selected(old('kategori_id', $berita->kategori_id) == $k->id)>
                                    {{ $k->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="isi" class="form-label fw-semibold">Isi Berita</label>
                        <textarea name="isi" id="isi" rows="6" class="form-control @error('isi') is-invalid @enderror" required>{{ old('isi', $berita->isi) }}</textarea>
                        @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label fw-semibold">Gambar Sampul</label>
                        @if ($berita->gambar)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $berita->gambar) }}"
                                     class="img-thumbnail rounded" style="max-height: 140px; object-fit: cover;">
                            </div>
                        @endif
                        <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                        @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tag Berita</label>
                        <div class="d-flex flex-wrap gap-3 border rounded p-2 bg-light">
                            @foreach ($tags as $tag)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tags[]"
                                           id="tag{{ $tag->id }}" value="{{ $tag->id }}"
                                           @checked(in_array($tag->id, old('tags', $berita->tags->pluck('id')->toArray())))>
                                    <label class="form-check-label small" for="tag{{ $tag->id }}">
                                        #{{ $tag->nama }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('tags') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">
                            <i class="bi bi-eye"></i> Dilihat {{ $berita->dilihat ?? 0 }} kali •
                            Terakhir diubah {{ $berita->updated_at ? $berita->updated_at->diffForHumans() : '-' }}
                        </small>
                    </div>

                    <div class="d-flex gap-2 pt-2 border-top mt-3">
                        <button type="submit" class="btn btn-primary px-4 fw-semibold" style="background-color: #0f2b48; border-color: #0f2b48;">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection