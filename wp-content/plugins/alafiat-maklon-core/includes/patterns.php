<?php
/**
 * Gutenberg Block Patterns & Shortcodes for Alafiat Maklon Herbal
 */
if (!defined('ABSPATH')) exit;

function alafiat_register_pattern_category() {
    register_block_pattern_category(
        'alafiat-maklon',
        array('label' => 'Alafiat Maklon Herbal')
    );
}
add_action('init', 'alafiat_register_pattern_category');

/**
 * Shortcode: [alafiat_landing_page]
 * Render entire landing page (Hero, Sediaan Grid, Jalur, Simulasi, Proses, FAQ, Footer)
 */
function alafiat_render_landing_page_shortcode() {
    $wa_number = esc_attr(get_option('alafiat_whatsapp_number', '6281234567890'));
    $company   = esc_html(get_option('alafiat_company_name', 'CV Al Afiat Sehat Alami'));
    $address   = esc_html(get_option('alafiat_factory_address', 'Magelang, Jawa Tengah'));
    
    ob_start();
    ?>
    <div class="alafiat-wrapper min-h-screen max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-8 font-sans">
        
        <!-- HEADER NAV -->
        <header class="bg-panel rounded-[20px] p-4 flex items-center justify-between border border-subtle shadow-sm">
            <div class="flex items-center gap-3">
                <img src="/wp-content/uploads/alafiat/simbol-pabrik-maklon-herbal.svg" alt="Logo Al Afiat" class="w-10 h-10 object-contain" />
                <div>
                    <span class="font-bold text-lg text-ink block leading-tight"><?php echo $company; ?></span>
                    <span class="text-xs text-inkMuted block">Pabrik Maklon Herbal CPOTB BPOM</span>
                </div>
            </div>
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-inkMuted">
                <a href="#sediaan" class="hover:text-pine transition-colors">Sediaan</a>
                <a href="#jalur-maklon" class="hover:text-pine transition-colors">Jalur Maklon</a>
                <a href="#simulasi" class="hover:text-pine transition-colors">Simulasi Maklon</a>
                <a href="#proses" class="hover:text-pine transition-colors">Alur CPOTB</a>
                <a href="#faq" class="hover:text-pine transition-colors">FAQ</a>
                <a href="/produk/" class="text-pine font-semibold hover:underline">Katalog Produk →</a>
            </nav>
            <div class="flex items-center gap-2">
                <button type="button" class="theme-toggle-btn w-10 h-10 rounded-full border border-subtle bg-soft flex items-center justify-center text-ink hover:border-pine transition-colors" title="Ubah Mode Gelap/Terang" aria-pressed="false">
                    ◐
                </button>
                <a href="https://wa.me/<?php echo $wa_number; ?>?text=Halo%20Tim%20Konsultan%20Maklon%20Al%20Afiat,%20saya%20ingin%20konsultasi%20maklon%20herbal." data-wa-cta="header_konsultasi" class="inline-flex items-center gap-2 bg-pine text-white text-xs sm:text-sm font-medium px-4 py-2.5 rounded-full hover:bg-pineHover transition-colors shadow-sm">
                    <span>Konsultasi WA</span>
                </a>
            </div>
        </header>

        <!-- 1. HERO SECTION -->
        <section id="top" class="bg-panel rounded-[28px] overflow-hidden border border-subtle shadow-sm grid grid-cols-1 lg:grid-cols-12 min-h-[580px]">
            <div class="lg:col-span-7 p-6 sm:p-10 lg:p-14 flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-pineTint text-pine text-xs font-semibold">
                            ✓ Sertifikasi CPOTB BPOM RI
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-soft text-oliveDark text-xs font-semibold">
                            ★ Halal Indonesia
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-soft text-inkMuted text-xs font-medium">
                            MOQ Mulai 250 Pcs
                        </span>
                    </div>

                    <h1 class="type-h1 text-ink">
                        Wujudkan Brand Herbal Sendiri. Legal, Aman, Berizin BPOM &amp; Halal.
                    </h1>

                    <p class="text-base sm:text-lg text-inkMuted leading-relaxed max-w-2xl">
                        Pabrik maklon herbal berstandar CPOTB resmi di Magelang. Tersedia jalur <strong>Take Over</strong> (produk siap edar dalam 1–2 bulan) maupun <strong>Custom Formulasi R&amp;D</strong> dengan kuantitas pemula ramah modal mulai 250 botol/boks.
                    </p>
                </div>

                <div class="space-y-4 pt-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="https://wa.me/<?php echo $wa_number; ?>?text=Halo%20Tim%20Konsultan%20Maklon%20Al%20Afiat,%20saya%20ingin%20konsultasi%20formula%20dan%20sampel%20maklon." data-wa-cta="hero_utama" class="inline-flex items-center gap-3 bg-pine text-white text-sm sm:text-base font-semibold px-6 py-3.5 rounded-full hover:bg-pineHover transition-colors shadow-md">
                            <span>Konsultasi Produk Gratis</span>
                            <span class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center text-xs">→</span>
                        </a>
                        <a href="#simulasi" class="inline-flex items-center gap-2 border border-subtle bg-soft text-ink text-sm sm:text-base font-medium px-5 py-3.5 rounded-full hover:border-pine transition-colors">
                            Lihat Estimasi Produksi
                        </a>
                        <a href="/produk/" class="inline-flex items-center gap-2 text-pine font-semibold text-sm px-4 py-3 hover:underline">
                            Lihat Katalog Sediaan →
                        </a>
                    </div>
                    <p class="text-xs text-inkMuted">
                        Bimbingan regulasi BPOM TR, formulasi apoteker, dan desain kemasan gratis hingga selesai.
                    </p>
                </div>
            </div>

            <div class="lg:col-span-5 bg-soft relative min-h-[320px] lg:min-h-full overflow-hidden flex items-center justify-center">
                <img src="/wp-content/uploads/alafiat/hero-maklon-alafiat.png" alt="Ragam produk sediaan maklon herbal CV Al Afiat" class="w-full h-full object-cover object-center max-h-[620px]" />
                <div class="absolute bottom-4 left-4 right-4 bg-panel/90 backdrop-blur-md p-3.5 rounded-xl border border-subtle text-xs text-ink shadow-sm">
                    <strong>Fasilitas Manufaktur:</strong> Ruang bersih bertekanan positif, tata udara HEPA filter, dan laboratorium kontrol mutu terakreditasi.
                </div>
            </div>
        </section>

        <!-- 2. SEDIAAN PRODUK GRID & FILTER -->
        <section id="sediaan" class="bg-panel rounded-[28px] p-6 sm:p-10 border border-subtle shadow-sm space-y-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-subtle pb-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-pine block mb-1">Pilihan Bentuk Sediaan</span>
                    <h2 class="type-h2 text-ink">Sediaan Maklon Standar CPOTB BPOM</h2>
                    <p class="text-sm sm:text-base text-inkMuted mt-1">Seluruh sediaan diproduksi di ruang higienis dengan jaminan uji mutu mikrobiologi dan stabilitas.</p>
                </div>
                <div class="flex items-center gap-2 overflow-x-auto pb-1" role="tablist">
                    <button type="button" class="tab-btn min-h-[44px] rounded-full px-4 text-sm font-medium border-[1.5px] border-pine text-ink bg-panel" data-tab-filter="all" aria-selected="true">Semua</button>
                    <button type="button" class="tab-btn min-h-[44px] rounded-full px-4 text-sm font-medium border border-subtle text-inkMuted bg-panel hover:border-pine" data-tab-filter="madu" aria-selected="false">Madu &amp; Sirup</button>
                    <button type="button" class="tab-btn min-h-[44px] rounded-full px-4 text-sm font-medium border border-subtle text-inkMuted bg-panel hover:border-pine" data-tab-filter="kapsul" aria-selected="false">Kapsul</button>
                    <button type="button" class="tab-btn min-h-[44px] rounded-full px-4 text-sm font-medium border border-subtle text-inkMuted bg-panel hover:border-pine" data-tab-filter="susu" aria-selected="false">Susu &amp; Serbuk</button>
                    <button type="button" class="tab-btn min-h-[44px] rounded-full px-4 text-sm font-medium border border-subtle text-inkMuted bg-panel hover:border-pine" data-tab-filter="minyak" aria-selected="false">Minyak &amp; VCO</button>
                    <button type="button" class="tab-btn min-h-[44px] rounded-full px-4 text-sm font-medium border border-subtle text-inkMuted bg-panel hover:border-pine" data-tab-filter="lainnya" aria-selected="false">Rajangan &amp; Krim</button>
                </div>
            </div>

            <div id="sediaan-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- CARD 1: MADU -->
                <article class="sediaan-card rounded-[22px] border border-subtle bg-soft overflow-hidden flex flex-col justify-between hover:border-pine transition-colors shadow-sm" data-category="madu">
                    <div class="p-5 space-y-4">
                        <div class="aspect-[4/3] rounded-[16px] overflow-hidden bg-white/60">
                            <img src="/wp-content/uploads/alafiat/sediaan-madu.png" alt="Madu Herbal" class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <span class="text-xs font-semibold text-pine block">Cairan Obat Dalam</span>
                            <h3 class="type-h3 text-ink mt-1">Madu &amp; Sirup Herbal</h3>
                            <p class="text-xs sm:text-sm text-inkMuted mt-2 leading-relaxed">Madu murni alami, sirup ekstrak rempah, formula lambung, pereda batuk, dan madu wanita berizin BPOM TR.</p>
                        </div>
                        <div class="border-t border-subtle pt-3 flex items-center justify-between text-xs text-inkMuted">
                            <span>MOQ: <strong>Mulai 250 botol</strong></span>
                            <span class="text-oliveDark font-semibold">BPOM TR &amp; Halal</span>
                        </div>
                    </div>
                    <div class="p-5 pt-0">
                        <a href="/produk/madu-sirup-herbal/" class="w-full inline-flex items-center justify-center gap-2 py-2.5 rounded-xl bg-panel border border-subtle text-ink font-semibold text-xs hover:border-pine transition-colors">
                            Lihat Detail &amp; Konsep Varian →
                        </a>
                    </div>
                </article>

                <!-- CARD 2: KAPSUL -->
                <article class="sediaan-card rounded-[22px] border border-subtle bg-soft overflow-hidden flex flex-col justify-between hover:border-pine transition-colors shadow-sm" data-category="kapsul">
                    <div class="p-5 space-y-4">
                        <div class="aspect-[4/3] rounded-[16px] overflow-hidden bg-white/60">
                            <img src="/wp-content/uploads/alafiat/sediaan-kapsul.png" alt="Kapsul Herbal" class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <span class="text-xs font-semibold text-pine block">Sediaan Kapsul</span>
                            <h3 class="type-h3 text-ink mt-1">Kapsul Ekstrak &amp; Minyak</h3>
                            <p class="text-xs sm:text-sm text-inkMuted mt-2 leading-relaxed">Kapsul gelatin halal atau vegetarian. Tersedia isian ekstrak serbuk kering terukur maupun kapsul minyak habbatussauda/ikan gabus.</p>
                        </div>
                        <div class="border-t border-subtle pt-3 flex items-center justify-between text-xs text-inkMuted">
                            <span>MOQ: <strong>Mulai 250 botol</strong></span>
                            <span class="text-oliveDark font-semibold">BPOM TR &amp; Halal</span>
                        </div>
                    </div>
                    <div class="p-5 pt-0">
                        <a href="/produk/kapsul-herbal/" class="w-full inline-flex items-center justify-center gap-2 py-2.5 rounded-xl bg-panel border border-subtle text-ink font-semibold text-xs hover:border-pine transition-colors">
                            Lihat Detail &amp; Konsep Varian →
                        </a>
                    </div>
                </article>

                <!-- CARD 3: SUSU & SERBUK -->
                <article class="sediaan-card rounded-[22px] border border-subtle bg-soft overflow-hidden flex flex-col justify-between hover:border-pine transition-colors shadow-sm" data-category="susu">
                    <div class="p-5 space-y-4">
                        <div class="aspect-[4/3] rounded-[16px] overflow-hidden bg-white/60">
                            <img src="/wp-content/uploads/alafiat/sediaan-susu.png" alt="Susu Kambing Etawa" class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <span class="text-xs font-semibold text-pine block">Serbuk Oral Herbal</span>
                            <h3 class="type-h3 text-ink mt-1">Susu Etawa &amp; Minuman Serbuk</h3>
                            <p class="text-xs sm:text-sm text-inkMuted mt-2 leading-relaxed">Susu kambing etawa murni tanpa aroma prengus, paduan jahe merah, temulawak, kurma, dan serbuk fungsional berkhasiat.</p>
                        </div>
                        <div class="border-t border-subtle pt-3 flex items-center justify-between text-xs text-inkMuted">
                            <span>MOQ: <strong>Mulai 250 boks</strong></span>
                            <span class="text-oliveDark font-semibold">BPOM TR &amp; Halal</span>
                        </div>
                    </div>
                    <div class="p-5 pt-0">
                        <a href="/produk/susu-etawa-serbuk-herbal/" class="w-full inline-flex items-center justify-center gap-2 py-2.5 rounded-xl bg-panel border border-subtle text-ink font-semibold text-xs hover:border-pine transition-colors">
                            Lihat Detail &amp; Konsep Varian →
                        </a>
                    </div>
                </article>

                <!-- CARD 4: MINYAK -->
                <article class="sediaan-card rounded-[22px] border border-subtle bg-soft overflow-hidden flex flex-col justify-between hover:border-pine transition-colors shadow-sm" data-category="minyak">
                    <div class="p-5 space-y-4">
                        <div class="aspect-[4/3] rounded-[16px] overflow-hidden bg-white/60">
                            <img src="/wp-content/uploads/alafiat/sediaan-minyak.jpg" alt="Minyak Herbal dan VCO" class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <span class="text-xs font-semibold text-pine block">Minyak Konsumsi &amp; Oles</span>
                            <h3 class="type-h3 text-ink mt-1">Minyak Herbal &amp; VCO</h3>
                            <p class="text-xs sm:text-sm text-inkMuted mt-2 leading-relaxed">Virgin Coconut Oil cold-pressed murni, minyak zaitun, minyak habbatussauda, dan minyak gosok aromaterapi pereda pegal.</p>
                        </div>
                        <div class="border-t border-subtle pt-3 flex items-center justify-between text-xs text-inkMuted">
                            <span>MOQ: <strong>Mulai 250 botol</strong></span>
                            <span class="text-oliveDark font-semibold">BPOM TR &amp; Halal</span>
                        </div>
                    </div>
                    <div class="p-5 pt-0">
                        <a href="/produk/minyak-herbal-vco/" class="w-full inline-flex items-center justify-center gap-2 py-2.5 rounded-xl bg-panel border border-subtle text-ink font-semibold text-xs hover:border-pine transition-colors">
                            Lihat Detail &amp; Konsep Varian →
                        </a>
                    </div>
                </article>

                <!-- CARD 5: RAJANGAN & SEMI PADAT -->
                <article class="sediaan-card rounded-[22px] border border-subtle bg-soft overflow-hidden flex flex-col justify-between hover:border-pine transition-colors shadow-sm" data-category="lainnya">
                    <div class="p-5 space-y-4">
                        <div class="aspect-[4/3] rounded-[16px] overflow-hidden bg-white/60">
                            <img src="/wp-content/uploads/alafiat/preview-bahan-herbal.jpg" alt="Teh Rajangan dan Semi Padat" class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <span class="text-xs font-semibold text-pine block">Sediaan Khusus CPOTB</span>
                            <h3 class="type-h3 text-ink mt-1">Teh Rajangan, Salep &amp; Gel</h3>
                            <p class="text-xs sm:text-sm text-inkMuted mt-2 leading-relaxed">Simplisia teh celup kantong piramida/reguler, krim herbal oles perawatan kulit, dan gel pereda sendi cepat meresap.</p>
                        </div>
                        <div class="border-t border-subtle pt-3 flex items-center justify-between text-xs text-inkMuted">
                            <span>MOQ: <strong>Menyesuaikan bahan</strong></span>
                            <span class="text-oliveDark font-semibold">Custom R&amp;D</span>
                        </div>
                    </div>
                    <div class="p-5 pt-0">
                        <a href="/produk/teh-rajangan-semi-padat/" class="w-full inline-flex items-center justify-center gap-2 py-2.5 rounded-xl bg-panel border border-subtle text-ink font-semibold text-xs hover:border-pine transition-colors">
                            Lihat Detail &amp; Konsep Varian →
                        </a>
                    </div>
                </article>

            </div>
        </section>

        <!-- 3. KOMPARASI DUA JALUR MAKLON -->
        <section id="jalur-maklon" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- JALUR 1: TAKE OVER -->
            <div class="bg-panel rounded-[28px] p-6 sm:p-10 border border-subtle shadow-sm flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-oliveBright text-ink text-xs font-bold">
                        PILIHAN TERCEPAT • 1–2 BULAN RILIS
                    </div>
                    <h2 class="type-h2 text-ink">Jalur Take Over (Siap Edar)</h2>
                    <p class="text-sm text-inkMuted leading-relaxed">
                        Manfaatkan formula obat tradisional dan nomor izin edar BPOM TR yang sudah terbit atas nama pabrik kami. Anda cukup membuat desain merek kemasan sendiri dan langsung mulai jualan.
                    </p>
                    <ul class="space-y-2.5 text-sm text-ink">
                        <li class="flex items-center gap-2.5">
                            <span class="text-pine font-bold">✓</span> Formula telah teruji khasiat dan stabil di pasaran
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-pine font-bold">✓</span> Tanpa masa tunggu uji laboratorium pendaftaran BPOM baru
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-pine font-bold">✓</span> MOQ ramah wirausahawan pemula (mulai 250 pcs)
                        </li>
                    </ul>
                </div>
                <div>
                    <a href="https://wa.me/<?php echo $wa_number; ?>?text=Halo%20Tim%20Konsultan%20Maklon%20Al%20Afiat,%20saya%20tertarik%20dengan%20Jalur%20Take%20Over%20produk%20siap%20edar." data-wa-cta="jalur_takeover" class="w-full inline-flex items-center justify-center gap-2 bg-pine text-white font-semibold py-3.5 rounded-full hover:bg-pineHover transition-colors shadow-sm">
                        Konsultasi Produk Siap Edar →
                    </a>
                </div>
            </div>

            <!-- JALUR 2: CUSTOM FORMULASI -->
            <div class="bg-pine text-white rounded-[28px] p-6 sm:p-10 border border-white/10 shadow-md flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-oliveBright text-xs font-bold">
                        FORMULA EKSKLUSIF • HAK MILIK BRAND
                    </div>
                    <h2 class="type-h2 text-white">Jalur Custom Formulasi R&amp;D</h2>
                    <p class="text-sm text-inkMuted-dark leading-relaxed">
                        Kembangkan formula unik bersama tim Apoteker &amp; R&amp;D kami. Pengurusan nomor registrasi BPOM TR baru, sertifikasi Halal, dan pendaftaran merek HKI atas nama perusahaan Anda.
                    </p>
                    <ul class="space-y-2.5 text-sm text-white/90">
                        <li class="flex items-center gap-2.5">
                            <span class="text-oliveBright font-bold">✓</span> Riset bahan aktif eksklusif &amp; sampel coba gratis
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-oliveBright font-bold">✓</span> Dilindungi perjanjian kerahasiaan resmi (NDA)
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-oliveBright font-bold">✓</span> Hak kepemilikan izin edar BPOM sepenuhnya milik Anda
                        </li>
                    </ul>
                </div>
                <div>
                    <a href="https://wa.me/<?php echo $wa_number; ?>?text=Halo%20Tim%20Konsultan%20Maklon%20Al%20Afiat,%20saya%20ingin%20riset%20formula%20Custom%20eksklusif." data-wa-cta="alur_custom" class="w-full inline-flex items-center justify-center gap-2 bg-oliveBright text-ink font-semibold py-3.5 rounded-full hover:bg-white transition-colors shadow-sm">
                        Riset Formula Custom →
                    </a>
                </div>
            </div>
        </section>

        <!-- 4. KALKULATOR SIMULASI MAKLON 3-KLIK -->
        <section id="simulasi" class="bg-panel rounded-[28px] overflow-hidden border border-subtle shadow-sm grid grid-cols-1 lg:grid-cols-12">
            <div class="lg:col-span-7 p-6 sm:p-10 space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-pine block mb-1">Simulasi 3-Klik Interaktif</span>
                    <h2 class="type-h2 text-ink">Hitung Konsep Maklon Anda</h2>
                    <p class="text-sm text-inkMuted mt-1">Pilih skema jalur, bentuk sediaan herbal, dan perkiraan kuantitas awal untuk melihat estimasi alur kerja dan estimasi waktu rilis.</p>
                </div>

                <!-- Group 1: Jalur -->
                <div class="space-y-2">
                    <label class="text-xs font-semibold text-ink uppercase tracking-wider block">1. Pilih Jalur Kerjasama</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2" id="sim-jalur-group">
                        <button type="button" class="sim-opt p-3 rounded-xl text-left border-[1.5px] border-pine bg-pineTint text-pine text-xs sm:text-sm font-medium transition-colors" data-sim-group="jalur" data-sim-value="Take Over Produk Siap Edar" aria-pressed="true">
                            <strong>Take Over Siap Edar</strong>
                            <span class="block text-xs opacity-80 mt-0.5">Izin BPOM sudah aktif (1-2 bln)</span>
                        </button>
                        <button type="button" class="sim-opt p-3 rounded-xl text-left border border-subtle bg-panel text-ink text-xs sm:text-sm font-medium transition-colors hover:border-pine" data-sim-group="jalur" data-sim-value="Custom Formulasi Baru" aria-pressed="false">
                            <strong>Custom Formulasi R&amp;D</strong>
                            <span class="block text-xs text-inkMuted mt-0.5">Formula baru eksklusif (3-6 bln)</span>
                        </button>
                    </div>
                </div>

                <!-- Group 2: Sediaan -->
                <div class="space-y-2">
                    <label class="text-xs font-semibold text-ink uppercase tracking-wider block">2. Pilih Bentuk Sediaan</label>
                    <div class="flex flex-wrap gap-2" id="sim-sediaan-group">
                        <button type="button" class="sim-opt px-3.5 py-2 rounded-full border-[1.5px] border-pine bg-pineTint text-pine text-xs font-medium transition-colors" data-sim-group="sediaan" data-sim-value="Madu &amp; Sirup Herbal" aria-pressed="true">Madu &amp; Sirup</button>
                        <button type="button" class="sim-opt px-3.5 py-2 rounded-full border border-subtle bg-panel text-ink text-xs font-medium transition-colors hover:border-pine" data-sim-group="sediaan" data-sim-value="Kapsul Herbal" aria-pressed="false">Kapsul Herbal</button>
                        <button type="button" class="sim-opt px-3.5 py-2 rounded-full border border-subtle bg-panel text-ink text-xs font-medium transition-colors hover:border-pine" data-sim-group="sediaan" data-sim-value="Susu Etawa &amp; Serbuk Herbal" aria-pressed="false">Susu &amp; Serbuk</button>
                        <button type="button" class="sim-opt px-3.5 py-2 rounded-full border border-subtle bg-panel text-ink text-xs font-medium transition-colors hover:border-pine" data-sim-group="sediaan" data-sim-value="Minyak Herbal &amp; VCO" aria-pressed="false">Minyak &amp; VCO</button>
                        <button type="button" class="sim-opt px-3.5 py-2 rounded-full border border-subtle bg-panel text-ink text-xs font-medium transition-colors hover:border-pine" data-sim-group="sediaan" data-sim-value="Teh Rajangan &amp; Semi Padat" aria-pressed="false">Rajangan &amp; Krim</button>
                    </div>
                </div>

                <!-- Group 3: Qty -->
                <div class="space-y-2">
                    <label class="text-xs font-semibold text-ink uppercase tracking-wider block">3. Kuantitas Batch Awal</label>
                    <div class="grid grid-cols-3 gap-2" id="sim-qty-group">
                        <button type="button" class="sim-opt p-3 rounded-xl text-center border-[1.5px] border-pine bg-pineTint text-pine text-xs sm:text-sm font-medium transition-colors" data-sim-group="qty" data-sim-value="250 pcs (MOQ Starter)" aria-pressed="true">
                            <strong>250 pcs</strong>
                            <span class="block text-[11px] opacity-80 mt-0.5">MOQ Pemula</span>
                        </button>
                        <button type="button" class="sim-opt p-3 rounded-xl text-center border border-subtle bg-panel text-ink text-xs sm:text-sm font-medium transition-colors hover:border-pine" data-sim-group="qty" data-sim-value="500 pcs (Standar)" aria-pressed="false">
                            <strong>500 pcs</strong>
                            <span class="block text-[11px] text-inkMuted mt-0.5">Skala Standar</span>
                        </button>
                        <button type="button" class="sim-opt p-3 rounded-xl text-center border border-subtle bg-panel text-ink text-xs sm:text-sm font-medium transition-colors hover:border-pine" data-sim-group="qty" data-sim-value="1.000+ pcs (Scale-up)" aria-pressed="false">
                            <strong>1.000+ pcs</strong>
                            <span class="block text-[11px] text-inkMuted mt-0.5">Harga Terbaik</span>
                        </button>
                    </div>
                </div>

                <div>
                    <button type="button" id="sim-reset-btn" class="text-xs text-inkMuted hover:text-pine underline">Reset Pilihan Simulasi</button>
                </div>
            </div>

            <!-- Output Box -->
            <div class="lg:col-span-5 bg-pine text-white p-6 sm:p-10 flex flex-col justify-between space-y-6">
                <div>
                    <span class="text-xs font-semibold text-oliveBright uppercase tracking-wider block mb-2">Ringkasan Konsep Anda</span>
                    <h3 class="type-h3 text-white mb-4">Estimasi Rencana Produksi</h3>

                    <dl class="space-y-3 border-t border-white/10 pt-4 text-sm">
                        <div>
                            <dt class="text-xs text-white/60">Jalur Kerjasama:</dt>
                            <dd id="out-jalur" class="font-semibold text-white">Take Over Produk Siap Edar</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-white/60">Bentuk Sediaan:</dt>
                            <dd id="out-sediaan" class="font-semibold text-white">Madu &amp; Sirup Herbal</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-white/60">Kuantitas Batch:</dt>
                            <dd id="out-qty" class="font-semibold text-oliveBright">250 pcs (MOQ Starter)</dd>
                        </div>
                        <div class="border-t border-white/10 pt-3">
                            <dt class="text-xs text-white/60">Estimasi Durasi &amp; Alur:</dt>
                            <dd id="out-estimasi" class="text-xs text-white/90 leading-relaxed mt-0.5">MOU, desain kemasan merek, dan registrasi edar cepat 1-2 bulan.</dd>
                        </div>
                    </dl>
                </div>

                <div>
                    <a href="https://wa.me/<?php echo $wa_number; ?>" id="sim-wa-cta" data-wa-cta="simulasi_wa" class="w-full inline-flex items-center justify-center gap-2 bg-oliveBright text-ink font-semibold py-3.5 rounded-full hover:bg-white transition-colors shadow-md text-sm">
                        Kirim Konsep ke WhatsApp Konsultan →
                    </a>
                    <p class="text-[11px] text-white/60 text-center mt-2">Dapatkan sampel gratis &amp; rincian perhitungan modal usaha.</p>
                </div>
            </div>
        </section>

        <!-- 5. ALUR PROSES KERJASAMA CPOTB (6 LANGKAH) -->
        <section id="proses" class="bg-panel rounded-[28px] p-6 sm:p-10 border border-subtle shadow-sm space-y-6">
            <div class="max-w-2xl">
                <span class="text-xs font-bold uppercase tracking-wider text-pine block mb-1">Standard Operating Procedure</span>
                <h2 class="type-h2 text-ink">6 Langkah Mudah Memulai Maklon Herbal</h2>
                <p class="text-sm sm:text-base text-inkMuted mt-1">Transparan, terstruktur, dan didampingi tim regulatori serta apoteker berpengalaman dari awal hingga produk siap dipasarkan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pt-4">
                <div class="p-5 rounded-2xl bg-soft border border-subtle space-y-2">
                    <span class="w-8 h-8 rounded-full bg-pine text-white text-xs font-bold flex items-center justify-center">1</span>
                    <h4 class="font-bold text-ink text-base">Konsultasi Ide &amp; Anggaran</h4>
                    <p class="text-xs sm:text-sm text-inkMuted leading-relaxed">Diskusikan target pasar, khasiat yang diinginkan, bentuk sediaan, serta budget investasi awal Anda.</p>
                </div>
                <div class="p-5 rounded-2xl bg-soft border border-subtle space-y-2">
                    <span class="w-8 h-8 rounded-full bg-pine text-white text-xs font-bold flex items-center justify-center">2</span>
                    <h4 class="font-bold text-ink text-base">Peracikan Sampel R&amp;D</h4>
                    <p class="text-xs sm:text-sm text-inkMuted leading-relaxed">Laboratorium kami meracik sampel fisik untuk Anda coba rasa, warna, aroma, dan teksturnya (bebas revisi).</p>
                </div>
                <div class="p-5 rounded-2xl bg-soft border border-subtle space-y-2">
                    <span class="w-8 h-8 rounded-full bg-pine text-white text-xs font-bold flex items-center justify-center">3</span>
                    <h4 class="font-bold text-ink text-base">Kesepakatan MOU &amp; NDA</h4>
                    <p class="text-xs sm:text-sm text-inkMuted leading-relaxed">Penandatanganan kontrak kerjasama produksi dan perlindungan kerahasiaan formula (*Non-Disclosure Agreement*).</p>
                </div>
                <div class="p-5 rounded-2xl bg-soft border border-subtle space-y-2">
                    <span class="w-8 h-8 rounded-full bg-pine text-white text-xs font-bold flex items-center justify-center">4</span>
                    <h4 class="font-bold text-ink text-base">Registrasi BPOM &amp; Halal</h4>
                    <p class="text-xs sm:text-sm text-inkMuted leading-relaxed">Tim regulasi kami memproses perizinan izin edar BPOM TR, sertifikasi Halal BPJPH, dan pendaftaran HKI merek Anda.</p>
                </div>
                <div class="p-5 rounded-2xl bg-soft border border-subtle space-y-2">
                    <span class="w-8 h-8 rounded-full bg-pine text-white text-xs font-bold flex items-center justify-center">5</span>
                    <h4 class="font-bold text-ink text-base">Desain Kemasan &amp; Cetak</h4>
                    <p class="text-xs sm:text-sm text-inkMuted leading-relaxed">Bantuan desain label botol, box, dan kemasan blister yang memenuhi aturan penandaan wajib dari BPOM RI.</p>
                </div>
                <div class="p-5 rounded-2xl bg-soft border border-subtle space-y-2">
                    <span class="w-8 h-8 rounded-full bg-pine text-white text-xs font-bold flex items-center justify-center">6</span>
                    <h4 class="font-bold text-ink text-base">Produksi Massal &amp; Distribusi</h4>
                    <p class="text-xs sm:text-sm text-inkMuted leading-relaxed">Produksi skala batch berstandar CPOTB di ruang bersih, uji QC akhir, dan pengiriman aman ke gudang Anda.</p>
                </div>
            </div>
        </section>

        <!-- 6. FAQ ACCORDION -->
        <section id="faq" class="bg-panel rounded-[28px] p-6 sm:p-10 border border-subtle shadow-sm space-y-6">
            <div class="max-w-2xl">
                <span class="text-xs font-bold uppercase tracking-wider text-pine block mb-1">Pertanyaan Umum</span>
                <h2 class="type-h2 text-ink">Jawaban Seputar Maklon Herbal</h2>
                <p class="text-sm text-inkMuted mt-1">Hal-hal yang sering ditanyakan calon pemilik brand sebelum memulai kerjasama maklon bersama kami.</p>
            </div>

            <div class="space-y-3 pt-2">
                
                <!-- FAQ 1 -->
                <div class="border border-subtle rounded-2xl overflow-hidden bg-soft">
                    <button type="button" class="faq-trigger w-full p-5 text-left flex items-center justify-between text-ink font-semibold text-sm sm:text-base hover:text-pine transition-colors" aria-expanded="false" aria-controls="faq-1">
                        <span>Berapa modal awal dan Minimum Order Quantity (MOQ) untuk mulai maklon?</span>
                        <span class="text-pine font-bold text-lg">＋</span>
                    </button>
                    <div id="faq-1" class="hidden px-5 pb-5 text-xs sm:text-sm text-inkMuted leading-relaxed border-t border-subtle/60 pt-3">
                        MOQ di fasilitas CV Al Afiat Sehat Alami sangat ramah pengusaha pemula, mulai dari <strong>250 botol/boks</strong> untuk jalur Take Over siap edar. Modal awal menyesuaikan bentuk sediaan dan bahan aktif. Anda dapat langsung mengkonsultasikan anggaran untuk simulasi RAB gratis.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="border border-subtle rounded-2xl overflow-hidden bg-soft">
                    <button type="button" class="faq-trigger w-full p-5 text-left flex items-center justify-between text-ink font-semibold text-sm sm:text-base hover:text-pine transition-colors" aria-expanded="false" aria-controls="faq-2">
                        <span>Berapa lama proses pembuatan produk sampai izin BPOM TR terbit?</span>
                        <span class="text-pine font-bold text-lg">＋</span>
                    </button>
                    <div id="faq-2" class="hidden px-5 pb-5 text-xs sm:text-sm text-inkMuted leading-relaxed border-t border-subtle/60 pt-3">
                        Jika memilih <strong>Jalur Take Over (Siap Edar)</strong>, izin edar sudah aktif dan produk siap rilis dalam <strong>1 hingga 2 bulan</strong> (fokus pencetakan kemasan dan produksi batch). Untuk <strong>Jalur Custom Formulasi</strong>, proses riset lab dan pendaftaran BPOM TR baru rata-rata memakan waktu <strong>3 hingga 6 bulan</strong>.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="border border-subtle rounded-2xl overflow-hidden bg-soft">
                    <button type="button" class="faq-trigger w-full p-5 text-left flex items-center justify-between text-ink font-semibold text-sm sm:text-base hover:text-pine transition-colors" aria-expanded="false" aria-controls="faq-3">
                        <span>Apakah formula yang dibuat dilindungi kerahasiaannya?</span>
                        <span class="text-pine font-bold text-lg">＋</span>
                    </button>
                    <div id="faq-3" class="hidden px-5 pb-5 text-xs sm:text-sm text-inkMuted leading-relaxed border-t border-subtle/60 pt-3">
                        Ya, 100%. Sebelum masuk tahap riset dan formulasi mendalam, kami menandatangani perjanjian kerahasiaan (*Non-Disclosure Agreement / NDA*) berkekuatan hukum untuk melindungi formula dan hak kekayaan intelektual Anda.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="border border-subtle rounded-2xl overflow-hidden bg-soft">
                    <button type="button" class="faq-trigger w-full p-5 text-left flex items-center justify-between text-ink font-semibold text-sm sm:text-base hover:text-pine transition-colors" aria-expanded="false" aria-controls="faq-4">
                        <span>Apakah dibantu untuk pendaftaran izin Halal dan Hak Merek HKI?</span>
                        <span class="text-pine font-bold text-lg">＋</span>
                    </button>
                    <div id="faq-4" class="hidden px-5 pb-5 text-xs sm:text-sm text-inkMuted leading-relaxed border-t border-subtle/60 pt-3">
                        Tentu. Tim regulatori kami menangani perizinan terpadu (one-stop service) meliputi izin edar BPOM TR, sertifikasi Halal BPJPH, dan pendaftaran hak merek dagang (HKI) atas nama Anda atau badan usaha Anda.
                    </div>
                </div>

            </div>
        </section>

        <!-- 7. FOOTER -->
        <footer class="bg-pine text-white rounded-[28px] p-8 sm:p-12 border border-white/10 shadow-md">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 border-b border-white/10 pb-8">
                <div class="md:col-span-6 space-y-3">
                    <div class="flex items-center gap-3">
                        <img src="/wp-content/uploads/alafiat/logo-al-afiat-putih.png" alt="Logo Al Afiat" class="h-8 object-contain" />
                        <span class="font-bold text-lg text-white"><?php echo $company; ?></span>
                    </div>
                    <p class="text-xs sm:text-sm text-white/80 max-w-md leading-relaxed">
                        Mitra terpercaya manufaktur maklon obat tradisional, suplemen herbal, madu, dan susu etawa berstandar CPOTB resmi BPOM RI &amp; Halal Indonesia.
                    </p>
                    <p class="text-xs text-oliveBright font-medium">Fasilitas Pabrik: <?php echo $address; ?></p>
                </div>
                <div class="md:col-span-3 space-y-2">
                    <h5 class="text-xs font-bold uppercase tracking-wider text-oliveBright">Bentuk Sediaan</h5>
                    <ul class="text-xs space-y-1.5 text-white/80">
                        <li><a href="/produk/madu-sirup-herbal/" class="hover:text-white">Madu &amp; Sirup Herbal</a></li>
                        <li><a href="/produk/kapsul-herbal/" class="hover:text-white">Kapsul Ekstrak &amp; Minyak</a></li>
                        <li><a href="/produk/susu-etawa-serbuk-herbal/" class="hover:text-white">Susu Kambing Etawa</a></li>
                        <li><a href="/produk/minyak-herbal-vco/" class="hover:text-white">Virgin Coconut Oil (VCO)</a></li>
                        <li><a href="/produk/teh-rajangan-semi-padat/" class="hover:text-white">Teh Rajangan &amp; Krim</a></li>
                    </ul>
                </div>
                <div class="md:col-span-3 space-y-3">
                    <h5 class="text-xs font-bold uppercase tracking-wider text-oliveBright">Hubungi Konsultan</h5>
                    <p class="text-xs text-white/80 leading-relaxed">Siap berkonsultasi mengenai formula atau ingin mengajukan sampel produk?</p>
                    <a href="https://wa.me/<?php echo $wa_number; ?>?text=Halo%20Tim%20Konsultan%20Maklon%20Al%20Afiat,%20saya%20ingin%20konsultasi." data-wa-cta="footer_konsultasi" class="inline-flex items-center gap-2 bg-oliveBright text-ink text-xs font-bold px-4 py-2.5 rounded-full hover:bg-white transition-colors">
                        Chat WhatsApp Resmi →
                    </a>
                </div>
            </div>
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between text-xs text-white/60 gap-4">
                <p>&copy; <?php echo date('Y'); ?> <?php echo $company; ?>. All rights reserved.</p>
                <div class="flex items-center gap-4">
                    <a href="#top" class="hover:text-white">Kembali ke Atas ↑</a>
                    <a href="/produk/" class="text-oliveBright hover:underline">Halaman Katalog Produk</a>
                </div>
            </div>
        </footer>

    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('alafiat_landing_page', 'alafiat_render_landing_page_shortcode');

/**
 * Shortcode: [alafiat_product_hub]
 * Render interactive product detail viewer (from produk.html)
 */
function alafiat_render_product_hub_shortcode() {
    $wa_number = esc_attr(get_option('alafiat_whatsapp_number', '6281234567890'));

    ob_start();
    ?>
    <div class="alafiat-product-hub max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-8 font-sans">
        
        <!-- HEADER NAV -->
        <header>
            <a href="<?php echo esc_url(home_url('/')); ?>">← Beranda</a>
            <h1>Katalog Sediaan</h1>
        </header>

        <!-- CATEGORY TAB BAR -->
        <div class="alafiat-catalog-tabs flex flex-wrap items-center gap-2" role="group" aria-label="Pilih sediaan">
            <button type="button" class="cat-tab min-h-[44px] rounded-full px-4 text-sm font-medium border-[1.5px] border-pine text-ink bg-panel" data-category-tab="madu" aria-pressed="true">Madu &amp; Sirup</button>
            <button type="button" class="cat-tab min-h-[44px] rounded-full px-4 text-sm font-medium border border-subtle text-inkMuted bg-panel hover:border-pine" data-category-tab="kapsul" aria-pressed="false">Kapsul Herbal</button>
            <button type="button" class="cat-tab min-h-[44px] rounded-full px-4 text-sm font-medium border border-subtle text-inkMuted bg-panel hover:border-pine" data-category-tab="susu" aria-pressed="false">Susu &amp; Serbuk</button>
            <button type="button" class="cat-tab min-h-[44px] rounded-full px-4 text-sm font-medium border border-subtle text-inkMuted bg-panel hover:border-pine" data-category-tab="minyak" aria-pressed="false">Minyak &amp; VCO</button>
            <button type="button" class="cat-tab min-h-[44px] rounded-full px-4 text-sm font-medium border border-subtle text-inkMuted bg-panel hover:border-pine" data-category-tab="lainnya" aria-pressed="false">Rajangan &amp; Krim</button>
        </div>

        <!-- MAIN INTERACTIVE VIEWER STAGE -->
        <section id="preview" class="alafiat-product-view">
            
            <!-- Left: Gallery & Zoom Preview -->
            <div class="space-y-3">
                <div id="preview-stage" class="overflow-hidden bg-soft aspect-[4/3]">
                    <img id="preview-main-img" src="/wp-content/uploads/alafiat/sediaan-madu.png" alt="Produk Maklon Madu" class="w-full h-full object-cover" />
                </div>
                <p id="preview-caption" class="text-xs text-inkMuted" aria-live="polite">Contoh botol kaca.</p>
                <div id="preview-thumbs" class="grid grid-cols-3 gap-3">
                    <!-- Thumbnails populated dynamically via alafiat-viewer.js -->
                </div>
            </div>

            <!-- Right: Details, Specs, Concept Picker & CTA -->
            <div class="space-y-5">
                <div>
                    <span id="preview-group-label" class="text-xs text-inkMuted block mb-1">Cairan Obat Dalam</span>
                    <h2 id="preview-title" class="type-h2 text-ink">Madu &amp; Sirup Herbal</h2>
                    <p id="preview-summary" class="text-inkMuted mt-2">Madu murni dan sirup ekstrak rempah.</p>
                    
                    <!-- Specs Grid -->
                    <dl id="preview-specs" class="grid grid-cols-2 gap-x-4 border-t border-subtle mt-4">
                        <!-- Specs populated dynamically -->
                    </dl>

                    <!-- Concept Picker -->
                    <div class="mt-5 space-y-2">
                        <h3 id="preview-concept-label" class="text-sm font-semibold text-ink">Konsep Varian</h3>
                        <div id="preview-concept-picker" class="flex flex-wrap gap-2" role="group" aria-labelledby="preview-concept-label">
                            <!-- Concept buttons populated dynamically -->
                        </div>
                        <p id="preview-concept-description" class="text-sm text-inkMuted" aria-live="polite"></p>
                    </div>
                </div>

                <div>
                    <a href="https://wa.me/<?php echo $wa_number; ?>" id="preview-wa-cta" class="alafiat-product-cta">
                        Minta Sampel &amp; Estimasi
                    </a>
                </div>

            </div>
        </section>

        <!-- SECONDARY DETAILS: KONSEP DAN DETAIL WADAH -->
        <section class="alafiat-catalog-details">
            <h2 class="type-h3 text-ink">Kemasan &amp; Kontrol Mutu</h2>
            <ul id="preview-details-list" class="alafiat-catalog-detail-list">
                <!-- Populated dynamically via JS -->
            </ul>
        </section>

    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('alafiat_product_hub', 'alafiat_render_product_hub_shortcode');
