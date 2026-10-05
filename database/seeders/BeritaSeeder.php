<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        Berita::create([
            'judul' => 'Malam Penuh Gengsi Dimulai! 16 Tim Berebut Mahkota Juara di Ajang CVC Cup 2026 Desa Jalatrang',
            'kategori' => 'Olahraga',
            'isi' => implode("\n", [
                'JalatrangNews; Himpunan Pemuda-Pemudi Dusun Cikandung yang tergabung dalam Cikandung Voli Ball Club (CVC) resmi menyelenggarakan ajang olahraga bertajuk CVC Cup 2026. Turnamen bola voli putra antar-dusun se-Kecamatan Cipaku ini resmi dibuka pada Sabtu, 26 September 2026, dan dijadwalkan berlangsung hingga 10 Oktober 2026.',
                'Pembukaan turnamen yang dipusatkan di Lapangan Bola Voli CVC, Dusun Cikandung, Desa Jalatrang, ini dibuka secara langsung oleh Kepala Desa Jalatrang, Dadi Haryadi.',
                'Dalam sambutannya, Dadi Haryadi mengapresiasi tinggi inisiatif para pemuda Dusun Cikandung yang sukses menggerakkan kegiatan positif berskala kecamatan ini. "Ajang ini bukan hanya sekadar mencari siapa yang menang atau kalah, tetapi menjadi momentum penting untuk mempererat silaturahmi, sportivitas, dan menggali bibit-bibit atlet bola voli potensial di wilayah Kecamatan Cipaku," ujar Dadi.'
            ]),
            'penulis' => 'Admin',
            'gambar' => 'cvc-cup.png',
        ]);

        Berita::create([
            'judul' => 'Pemerintah Desa Jalatrang Kukuhkan Desa Siaga TB, Perkuat Kolaborasi Lintas Sektor Basmi Tuberkulosis',
            'kategori' => 'Pendidikan',
            'isi' => implode("\n", [
                'JalatrangNews; Pemerintah Desa Jalatrang, Kecamatan Cipaku, Kabupaten Ciamis, menunjukkan komitmen nyata dalam meningkatkan kesehatan masyarakat dengan menggelar Sosialisasi Pencegahan Penyakit Menular (TBC) sekaligus Pembentukan Desa Siaga Tuberkulosis (TB). Kegiatan strategis ini diselenggarakan pada Senin, 28 September 2026, di aula desa Jalatrang.',
                'Acara yang dihadiri oleh puluhan pemangku kepentingan tingkat desa ini bertujuan untuk membangun kesadaran kolektif serta memperkuat jejaring deteksi dini penularan TBC langsung dari tingkat akar rumput.',
                'Kepala Desa Jalatrang dalam sambutannya menekankan pentingnya peran aktif seluruh elemen masyarakat dalam memutus mata rantai penyebaran TBC. Pembentukan "Desa Siaga TB" diharapkan mampu menjadi garda terdepan dalam penemuan kasus baru secara cepat dan tepat sehingga penanganan medis dapat segera dilakukan.'
            ]),
            'penulis' => 'Admin',
            'gambar' => 'desa-siaga.png',
        ]);
    }
}