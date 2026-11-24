# 1. Alafiat Maklon Herbal WordPress Gutenberg Architecture

Untuk menerapkan landing page dan katalog produk dari `C:\KAIRAV\alafiat_project` ke WordPress, diputuskan menggunakan arsitektur **Gutenberg-Native** dengan Custom Post Type (`produk_maklon`), Block Patterns, dan Vanilla JS terenkapsulasi, didukung menu pengaturan terpusat di WP-Admin.

## Status
Accepted

## Context
Klien membutuhkan platform web pemasaran terpadu untuk pabrik maklon herbal CV Al Afiat Sehat Alami. Sumber rujukan (`alafiat_project`) memiliki komponen interaktif yang kaya (Kalkulator Simulasi Jalur & Biaya Maklon, Tabbed Product Viewer dengan varian konsep, dan dynamic WhatsApp CTA) serta kebutuhan data produk yang terperinci. Website harus cepat (skor Core Web Vitals tinggi), mudah dikelola tim marketing via Gutenberg, dan tidak terbebani plugin pihak ketiga yang rentan rusak atau lambat.

## Decisions
1. **Custom Post Type `produk_maklon`**: Data sediaan produk detail (Madu, Kapsul, Susu, Minyak, Rajangan) dikelola sebagai CPT berstruktur dengan meta fields (spesifikasi, galeri foto, konsep varian khasiat, dan izin BPOM TR) untuk kemudahan update konten serta optimalisasi SEO per sediaan.
2. **Gutenberg-Native & Vanilla JS**: Seluruh seksi di Beranda dan Halaman Produk dibangun menggunakan Gutenberg Block Patterns dan CSS token terisolasi, didukung Vanilla JS ringan untuk interaksi simulasi dan galeri tanpa ketergantungan pada page builder berat (Elementor/Spectra).
3. **Beranda, arsip produk, dan detail produk**. Beranda berada di `/`. Arsip CPT berada di `/produk/` dan menggunakan Query Loop Gutenberg. Setiap produk memiliki halaman sendiri di `/produk/{slug}/` untuk spesifikasi, galeri, dan varian yang tersedia. URL lama dengan awalan `/produk-maklon/` atau parameter `sediaan` dialihkan ke halaman kanonis yang sesuai.
4. **Dynamic WhatsApp & Company Settings**: Pengaturan nomor WhatsApp tujuan, nama bisnis, dan kontak dipusatkan pada menu pengaturan khusus di dashboard WP-Admin.

## Consequences
- Kecepatan pemuatan halaman tetap maksimal (< 1.5 detik) tanpa bloatware.
- Data produk di backend terstruktur rapi dan dapat diekspor/diintegrasikan dengan REST API di kemudian hari.
- Tim marketing dapat mengedit teks halaman langsung melalui Gutenberg Block Editor standar.
