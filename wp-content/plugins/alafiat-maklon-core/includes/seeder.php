<?php
/**
 * Database Seeder: Produk Maklon & Halaman Utama
 */
if (!defined('ABSPATH')) exit;

function alafiat_seed_data() {
    // 1. Seed 5 Produk Maklon jika belum ada
    $products = array(
        array(
            'title'   => 'Maklon Madu & Sirup Herbal',
            'slug'    => 'madu-sirup-herbal',
            'sediaan' => 'madu',
            'excerpt' => 'Madu murni alami, sirup ekstrak rempah, formula lambung, pereda batuk, dan madu wanita berizin BPOM TR & Halal.',
            'content' => 'Layanan maklon sediaan cairan obat dalam berupa madu murni dan sirup ekstrak rempah herbal. Diproduksi di ruang bersih berstandar CPOTB dengan uji laboratorium stabilitas dan cemaran mikroba terjamin. MOQ mulai 250 botol.',
            'moq'     => 'Mulai 250 botol',
            'izin'    => 'BPOM TR & Halal',
            'kemasan' => 'Botol kaca atau plastik segel',
            'jalur'   => 'Take Over & Custom'
        ),
        array(
            'title'   => 'Maklon Kapsul Herbal',
            'slug'    => 'kapsul-herbal',
            'sediaan' => 'kapsul',
            'excerpt' => 'Kapsul ekstrak serbuk rempah dan kapsul minyak (habbatussauda, minyak ikan gabus) berstandar CPOTB BPOM TR.',
            'content' => 'Sediaan kapsul herbal dengan cangkang gelatin halal atau vegetarian. Mesin pengisian kapsul otomatis memastikan keseragaman bobot dan dosis bahan aktif terukur. Tersedia jalur Take Over siap edar maupun formulasi kustom eksklusif.',
            'moq'     => 'Mulai 250 botol',
            'izin'    => 'BPOM TR & Halal',
            'kemasan' => 'Botol HDPE, amber, blister',
            'jalur'   => 'Take Over & Custom'
        ),
        array(
            'title'   => 'Maklon Susu Etawa & Serbuk Herbal',
            'slug'    => 'susu-etawa-serbuk-herbal',
            'sediaan' => 'susu',
            'excerpt' => 'Susu kambing etawa murni tanpa bau prengus dan serbuk rempah fungsional berkhasiat dengan izin resmi BPOM TR.',
            'content' => 'Sediaan serbuk oral susu kambing etawa dan minuman serbuk fungsional berkhasiat (jahe merah, temulawak, kurma). Proses homogenisasi modern memastikan serbuk mudah larut dan tidak menggumpal. Terdaftar resmi kategori obat tradisional BPOM TR.',
            'moq'     => 'Mulai 250 boks',
            'izin'    => 'BPOM TR & Halal',
            'kemasan' => 'Pouch, sachet, box karton',
            'jalur'   => 'Siap Edar & Custom'
        ),
        array(
            'title'   => 'Maklon Minyak Herbal & VCO',
            'slug'    => 'minyak-herbal-vco',
            'sediaan' => 'minyak',
            'excerpt' => 'Virgin Coconut Oil cold-pressed murni, minyak zaitun, habbatussauda, dan minyak gosok aromaterapi pereda pegal.',
            'content' => 'Sediaan minyak nabati murni untuk konsumsi obat dalam maupun cairan obat luar. Diproses higienis dengan kontrol mutu kadar air dan asam lemak bebas (FFA) rendah untuk daya simpan maksimal.',
            'moq'     => 'Mulai 250 botol',
            'izin'    => 'BPOM TR & Halal',
            'kemasan' => 'Botol pipet, segel aluminium, roll-on',
            'jalur'   => 'Take Over & Custom'
        ),
        array(
            'title'   => 'Maklon Teh Rajangan & Semi Padat',
            'slug'    => 'teh-rajangan-semi-padat',
            'sediaan' => 'lainnya',
            'excerpt' => 'Simplisia teh celup kantong higienis, krim herbal perawatan kulit, dan gel pereda sendi cepat meresap.',
            'content' => 'Sediaan khusus fasilitas CPOTB meliputi teh herbal rajangan daun kelor/jati cina serta sediaan oles semi padat (krim, salep, gel herbal). Disesuaikan dengan riset formula dan target pasar spesifik brand Anda.',
            'moq'     => 'Menyesuaikan bahan',
            'izin'    => 'BPOM TR & Halal',
            'kemasan' => 'Kantong celup, pouch, pot krim, tube',
            'jalur'   => 'Custom R&D Formulasi'
        )
    );

    foreach ($products as $prod) {
        $existing = get_page_by_path($prod['slug'], OBJECT, 'produk_maklon');
        if (!$existing) {
            $post_id = wp_insert_post(array(
                'post_title'   => $prod['title'],
                'post_name'    => $prod['slug'],
                'post_content' => '<!-- wp:paragraph --><p>' . esc_html($prod['content']) . '</p><!-- /wp:paragraph -->',
                'post_excerpt' => $prod['excerpt'],
                'post_status'  => 'publish',
                'post_type'    => 'produk_maklon'
            ));

            if ($post_id && !is_wp_error($post_id)) {
                update_post_meta($post_id, '_alafiat_sediaan_key', $prod['sediaan']);
                update_post_meta($post_id, '_alafiat_moq', $prod['moq']);
                update_post_meta($post_id, '_alafiat_izin', $prod['izin']);
                update_post_meta($post_id, '_alafiat_kemasan', $prod['kemasan']);
                update_post_meta($post_id, '_alafiat_jalur', $prod['jalur']);
            }
        }
    }

    // Ambil konten visual blok Gutenberg
    if (function_exists('alafiat_get_visual_landing_blocks')) {
        $visual_blocks = alafiat_get_visual_landing_blocks();
    } else {
        $visual_blocks = '<!-- wp:shortcode -->[alafiat_landing_page]<!-- /wp:shortcode -->';
    }

    // 2. Seed / Update Halaman Beranda
    $home_page = get_page_by_path('beranda');
    if (!$home_page) {
        $home_id = wp_insert_post(array(
            'post_title'   => 'Beranda',
            'post_name'    => 'beranda',
            'post_content' => wp_slash($visual_blocks),
            'post_status'  => 'publish',
            'post_type'    => 'page'
        ));

        if ($home_id && !is_wp_error($home_id)) {
            update_option('show_on_front', 'page');
            update_option('page_on_front', $home_id);
        }
    } else {
        if (trim($home_page->post_content) === '' && $visual_blocks !== '') {
            wp_update_post(array(
                'ID'           => $home_page->ID,
                'post_content' => wp_slash($visual_blocks),
            ));
        }
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_page->ID);
    }
}
