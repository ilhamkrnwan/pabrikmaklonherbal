# 2. CSS Native Animations and Contextual Image Detail Modal

Status: Accepted

## Context
Proyek sempat memasang GSAP + ScrollTrigger (~118 KB minified JS) untuk animasi masuk dan lightbox zoom gambar. Namun [ADR-0001](./0001-alafiat-wordpress-gutenberg-architecture.md) mensyaratkan skrip Vanilla JS ringan tanpa bloatware dengan target waktu muat `< 1.5 detik`, serta [rencana pengembangan](../referensi/rencana-pengembangan-website.md) menekankan optimasi kecepatan dan pengalaman baca yang berwibawa.

## Decision
1. **CSS Native + `IntersectionObserver` ringan menggantikan GSAP**: Animasi entrance hero, reveal bertahap per section, progres garis alur `#proses`, sticky active nav tracking di desktop, dan transisi UI/UX dijalankan memakai CSS transitions/keyframes yang memanfaatkan `transform` dan `opacity` dengan pemicu `IntersectionObserver` (~2–3 KB JS tanpa library eksternal). Seluruh animasi menghormati `prefers-reduced-motion`.
2. **Modal Detail Gambar kontekstual**: Mengklik gambar konten (Hero, Sediaan, Proses, Sertifikat, Portofolio, Katalog, dan Galeri Produk — mengecualikan logo header/footer serta grid logo `#mitra`) membuka modal detail yang menampilkan salinan gambar lokal untuk akses instan, kontrol zoom `1x`/`1.65x`, navigasi antar gambar, serta panel keterangan dan tautan aksi kontekstual (misalnya tautan dokumen resmi `alafiatgroup.co.id` pada sertifikat atau tautan halaman detail produk).

## Consequences
- Menghemat ~118 KB payload JavaScript dan meniadakan dependensi npm/vendor eksternal di plugin.
- Halaman tetap tampil utuh meski JavaScript gagal atau lambat dimuat karena state tersembunyi hanya aktif ketika kelas penanda inisialisasi terpasang dan `prefers-reduced-motion: no-preference` terpenuhi.
- Animasi *scroll-scrubbing* atau timeline kompleks lintas elemen tidak digunakan; bila kelak dibutuhkan, perubahan harus dipertimbangkan ulang terhadap anggaran performa.
