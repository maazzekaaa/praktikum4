<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar berita beserta fitur pencarian dan filter
     */
    public function index(Request $request)
    {
        $query = Berita::query();

        if ($request->filled('kata_kunci')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->kata_kunci . '%')
                  ->orWhere('isi', 'like', '%' . $request->kata_kunci . '%');
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $beritas = $query->latest()->paginate(6)->withQueryString();

        return view('berita.index', compact('beritas'));
    }

    /**
     * Menampilkan form tambah berita baru
     */
    public function create()
    {
        return view('berita.create');
    }

    /**
     * Menyimpan data berita baru ke storage public dan database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string',
            'isi'      => 'required|string',
            'gambar'   => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'penulis'  => 'nullable|string',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            
            // Menyimpan gambar dengan menegaskan disk 'public'
            $file->storeAs('', $filename, 'public');
            $validated['gambar'] = $filename;
        }

        $validated['penulis'] = $request->input('penulis', 'Admin');
        $validated['dilihat'] = 0;

        Berita::create($validated);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Menampilkan halaman detail berita
     */
    public function show(Berita $berita)
    {
        $berita->increment('dilihat');

        $beritaTerkait = Berita::where('kategori', $berita->kategori)
                               ->where('id', '!=', $berita->id)
                               ->take(3)
                               ->get();

        return view('berita.show', compact('berita', 'beritaTerkait'));
    }

    /**
     * Menampilkan form edit berita
     */
    public function edit(Berita $berita)
    {
        return view('berita.edit', compact('berita'));
    }

    /**
     * Memperbarui data berita di database
     */
    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string',
            'isi'      => 'required|string',
            'gambar'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'penulis'  => 'nullable|string',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus berkas lama dari disk public jika ada
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $file->storeAs('', $filename, 'public');
            $validated['gambar'] = $filename;
        }

        $berita->update($validated);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Menghapus berita dari database
     */
    public function destroy(Berita $berita)
    {
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}