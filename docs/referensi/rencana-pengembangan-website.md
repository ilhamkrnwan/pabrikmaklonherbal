# Rencana pengembangan website Al Afiat

Dokumen serah terima untuk pengembangan lanjutan situs maklon herbal CV Al Afiat Sehat Alami. Urutan prioritas mengikuti brief.

## Kondisi awal

- Beranda `/` memakai blok Gutenberg. Hero sudah memiliki deskripsi pemasaran, CTA konsultasi WhatsApp, dan tautan ke sediaan. Pertahankan deskripsi yang membantu calon pelanggan memahami tawaran dan gunakan label pendukung yang pendek.
- Katalog Beranda menampilkan paling banyak dua baris per halaman di desktop dan dapat digeser horizontal di ponsel. Arsip `/produk/` memakai daftar kartu yang digulir vertikal, dengan pagination bila diperlukan dan CTA konsultasi di bawah daftar.
- Detail `/produk/{slug}/` memuat spesifikasi, galeri, varian jika tersedia, CTA konsultasi di bagian bawah, lalu Produk Terkait. Kartu menampilkan foto di atas informasi dan tombol panah.
- Gunakan sistem tombol yang sudah disepakati. Aksi utama memakai kapsul berwarna, aksi sekunder memakai kapsul bergaris tipis, dan tautan pada kartu memakai panah dalam lingkaran.

## Prioritas dan kriteria selesai

| Prioritas | Pekerjaan | Dampak | Kriteria selesai |
| --- | --- | --- | --- |
| 1 | Perkuat hero dan CTA | Meningkatkan ketertarikan | Judul menyampaikan manfaat maklon untuk pemilik merek. Deskripsi membedakan jalur produk siap edar dan formulasi custom. CTA utama mengarah ke WhatsApp dengan pesan yang relevan. Tautan sediaan mudah ditemukan. |
| 2 | Tambahkan foto asli fasilitas pabrik | Meningkatkan kepercayaan | Gunakan foto resmi yang tersedia untuk area produksi, pengemasan, dan kontrol mutu. Pilih foto utama untuk hero atau bagian fasilitas, lalu tambahkan keterangan faktual dan teks alternatif sesuai isi foto. |
| 3 | Tambahkan portofolio dan testimoni | Meyakinkan calon pelanggan | Tampilkan proyek yang mendapat izin publikasi. Setiap entri menjelaskan jenis sediaan dan ruang lingkup pekerjaan. Kutipan, logo, foto, dan hasil yang dicantumkan berasal dari bahan yang disetujui pelanggan. |
| 4 | Perbaiki katalog dan detail produk | Mempermudah pemahaman | Seragamkan judul, foto, ringkasan, dan info MOQ. Data detail menjelaskan varian, kemasan, dan jalur maklon jika tersedia. Uji alur Beranda → arsip → detail → konsultasi dan Produk Terkait. |
| 5 | Perbaiki FAQ dan informasi MOQ | Mengurangi pertanyaan berulang | Konfirmasi MOQ dan satuannya per sediaan atau jalur. Jawab pertanyaan tentang sampel, estimasi waktu, dan pengurusan izin dengan informasi yang disetujui. Samakan angka dan satuan di hero, katalog, detail, dan FAQ. |
| 6 | Optimasi SEO dan kecepatan | Mendukung trafik organik | Ukur kinerja Beranda, arsip, dan satu detail sebelum dan sesudah perubahan. Periksa judul halaman, meta description, URL kanonis, dan sitemap. Gunakan gambar responsif, prioritaskan foto hero, dan tunda pemuatan foto di bawah layar pertama. |
| 7 | Perbaiki tampilan mobile | Meningkatkan kenyamanan pengguna | Uji pada lebar 320, 390, dan 768 px. Periksa keterbacaan hero, target sentuh, filter, scroll kartu di Beranda dan Produk Terkait, daftar vertikal arsip, serta CTA WhatsApp. Pastikan gulir horizontal terbatas pada area kartu yang memang dapat digeser. |

## Arah visual

Gunakan **Pharmaceutical Corporate** sebagai dasar hierarki dan kredibilitas. Terapkan **Natural Herbal Branding** pada fotografi produk dan bahan. Gunakan **Industrial Manufacturing** untuk menunjukkan proses, fasilitas, dan kapabilitas pabrik.

- **Pharmaceutical Corporate** memakai tata letak bersih, deskripsi kapabilitas yang mudah dipindai, dan satu CTA konsultasi yang jelas. Referensi ini cocok untuk struktur hero dan cara menyampaikan keunggulan perusahaan. [HBM](gambar/01-pharmaceutical-corporate-hbm.png)
- **Natural Herbal Branding** memakai palet alami dan fotografi bahan serta produk yang menonjol. Terapkan pendekatannya pada visual dengan warna hijau dan krem Al Afiat. [AyruVital](gambar/02-natural-herbal-branding-ayruvital.png)
- **Industrial Manufacturing** memperlihatkan proses produksi dengan foto yang dominan, judul tegas, dan jalan masuk yang jelas ke profil fasilitas. Gunakan pendekatan ini untuk bagian fasilitas, proses maklon, dan kontrol mutu. [Radish Technologies](gambar/03-industrial-manufacturing-radish.png)

## Mulai dari sini

1. Kerjakan prioritas 1 pada hero Gutenberg sambil mengumpulkan foto dan data untuk prioritas 2–3. Pilih judul, pertahankan penjelasan dua jalur maklon, dan uji pesan CTA di tautan WhatsApp tanpa mengirimnya.
2. Siapkan foto resmi fasilitas, keterangan setiap lokasi atau proses, contoh proyek yang boleh dipublikasikan, dan kutipan pelanggan yang sudah disetujui. Konfirmasi MOQ, estimasi, serta dokumen pendukung klaim izin dan sertifikasi sebelum menampilkannya.
3. Setelah setiap tahap, periksa desktop, ponsel, dan editor Gutenberg. Catat halaman yang diuji, bukti tampilan, serta data yang masih menunggu konfirmasi.

## Titik masuk di proyek

- [Arsitektur WordPress Gutenberg](../adr/0001-alafiat-wordpress-gutenberg-architecture.md)
- [Pola blok Beranda](../../wp-content/plugins/alafiat-maklon-core/patterns/landing.html)
- [Template arsip produk](../../wp-content/themes/alafiat-maklon-theme/templates/archive-produk_maklon.html)
- [Render detail dan Produk Terkait](../../wp-content/plugins/alafiat-maklon-core/includes/cpt.php)
