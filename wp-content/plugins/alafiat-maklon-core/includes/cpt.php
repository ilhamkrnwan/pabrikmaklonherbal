<?php
/**
 * Custom Post Type: produk_maklon & Single Post Content Filter
 */
if (!defined('ABSPATH')) exit;

function alafiat_register_cpt_produk_maklon() {
    $labels = array(
        'name'                  => 'Produk Maklon',
        'singular_name'         => 'Produk Maklon',
        'menu_name'             => 'Produk Maklon',
        'name_admin_bar'        => 'Produk Maklon',
        'add_new'               => 'Tambah Produk',
        'add_new_item'          => 'Tambah Produk Maklon Baru',
        'new_item'              => 'Produk Maklon Baru',
        'edit_item'             => 'Edit Produk Maklon',
        'view_item'             => 'Lihat Produk Maklon',
        'all_items'             => 'Semua Produk Maklon',
        'search_items'          => 'Cari Produk Maklon',
        'not_found'             => 'Produk tidak ditemukan',
        'not_found_in_trash'    => 'Tidak ada produk di kotak sampah',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'produk', 'with_front' => false),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-drumstick',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true,
    );

    register_post_type('produk_maklon', $args);

    add_rewrite_rule('^produk-maklon/?$', 'index.php?post_type=produk_maklon&alafiat_legacy_product=archive', 'top');
    add_rewrite_rule('^produk-maklon/page/([1-9][0-9]*)/?$', 'index.php?post_type=produk_maklon&paged=$matches[1]&alafiat_legacy_product=archive', 'top');
    add_rewrite_rule('^produk-maklon/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?post_type=produk_maklon&feed=$matches[1]&alafiat_legacy_product=archive', 'top');
    add_rewrite_rule('^produk-maklon/([^/]+)/?$', 'index.php?produk_maklon=$matches[1]&alafiat_legacy_product=single', 'top');

    // Taxonomy: Kategori Sediaan
    $tax_labels = array(
        'name'              => 'Kategori Sediaan',
        'singular_name'     => 'Kategori Sediaan',
        'search_items'      => 'Cari Kategori',
        'all_items'         => 'Semua Kategori',
        'edit_item'         => 'Edit Kategori',
        'update_item'       => 'Perbarui Kategori',
        'add_new_item'      => 'Tambah Kategori Baru',
        'new_item_name'     => 'Nama Kategori Baru',
        'menu_name'         => 'Kategori Sediaan',
    );

    register_taxonomy('kategori_sediaan', array('produk_maklon'), array(
        'hierarchical'      => true,
        'labels'            => $tax_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'sediaan'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'alafiat_register_cpt_produk_maklon');

function alafiat_limit_product_archive($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_post_type_archive('produk_maklon') && !$query->is_feed()) {
        $query->set('posts_per_archive_page', 6);
    }
}
add_action('pre_get_posts', 'alafiat_limit_product_archive');

function alafiat_product_query_vars($query_vars) {
    $query_vars[] = 'alafiat_legacy_product';
    return $query_vars;
}
add_filter('query_vars', 'alafiat_product_query_vars');

function alafiat_refresh_product_rewrites() {
    $version = '2';
    if (get_option('alafiat_product_rewrite_version') !== $version) {
        flush_rewrite_rules(false);
        update_option('alafiat_product_rewrite_version', $version, false);
    }
}
add_action('wp_loaded', 'alafiat_refresh_product_rewrites');

function alafiat_redirect_legacy_product_urls() {
    $legacy = get_query_var('alafiat_legacy_product');
    $destination = '';

    if ($legacy === 'single' && is_singular('produk_maklon')) {
        $destination = get_permalink(get_queried_object_id());
    } elseif ($legacy === 'archive' && is_post_type_archive('produk_maklon')) {
        $destination = get_post_type_archive_link('produk_maklon');
        if (is_feed()) {
            $destination = get_post_type_archive_feed_link('produk_maklon', get_query_var('feed'));
        } elseif (is_paged()) {
            global $wp_rewrite;
            $destination = user_trailingslashit(trailingslashit($destination) . $wp_rewrite->pagination_base . '/' . get_query_var('paged'), 'paged');
        }
    } elseif (is_post_type_archive('produk_maklon') && !is_feed() && isset($_GET['sediaan']) && is_string($_GET['sediaan'])) {
        $category = sanitize_key(wp_unslash($_GET['sediaan']));
        if (array_key_exists($category, alafiat_product_photo_files())) {
            $matches = get_posts(array(
                'post_type' => 'produk_maklon',
                'post_status' => 'publish',
                'meta_key' => '_alafiat_sediaan_key',
                'meta_value' => $category,
                'numberposts' => 1,
                'orderby' => 'ID',
                'order' => 'ASC',
                'fields' => 'ids',
            ));
            if ($matches) {
                $destination = get_permalink($matches[0]);
            }
        }
        $destination = $destination ?: get_post_type_archive_link('produk_maklon');
    }

    if ($destination && wp_safe_redirect($destination, 301, 'Alafiat')) {
        exit;
    }
}
add_action('template_redirect', 'alafiat_redirect_legacy_product_urls', 5);

function alafiat_product_photo_files() {
    return array(
        'madu' => 'sediaan-madu.png',
        'kapsul' => 'sediaan-kapsul.png',
        'susu' => 'sediaan-susu.png',
        'minyak' => 'sediaan-minyak.jpg',
        'lainnya' => 'preview-bahan-herbal.jpg',
    );
}

function alafiat_product_photo($post_id, $image_id = '') {
    $attributes = $image_id !== '' ? array('id' => $image_id) : array();
    $photo = get_the_post_thumbnail($post_id, 'large', $attributes);
    if ($photo) {
        return $photo;
    }

    $photos = alafiat_product_photo_files();
    $category = get_post_meta($post_id, '_alafiat_sediaan_key', true);
    if (!isset($photos[$category])) {
        return '';
    }

    $src = trailingslashit(wp_get_upload_dir()['baseurl']) . 'alafiat/' . $photos[$category];
    return '<img' . ($image_id !== '' ? ' id="' . esc_attr($image_id) . '"' : '')
        . ' src="' . esc_url($src) . '" alt="' . esc_attr(get_the_title($post_id)) . '">';
}

function alafiat_archive_photo_fallback($content, $block, $instance) {
    if ($content !== '' || ($block['attrs']['className'] ?? '') !== 'alafiat-archive-photo'
        || ($instance->context['postType'] ?? '') !== 'produk_maklon') {
        return $content;
    }

    $photo = alafiat_product_photo((int) ($instance->context['postId'] ?? 0));
    return $photo ? '<figure class="wp-block-post-featured-image alafiat-archive-photo">' . $photo . '</figure>' : '';
}
add_filter('render_block_core/post-featured-image', 'alafiat_archive_photo_fallback', 10, 3);

function alafiat_product_card_meta($post_id) {
    $minimum = preg_replace('/^Mulai\s+/i', '', (string) get_post_meta($post_id, '_alafiat_moq', true));
    $permit = get_post_meta($post_id, '_alafiat_izin', true);
    $facts = array_filter(array($minimum !== '' ? 'MOQ ' . $minimum : '', $permit));
    return $facts ? '<p class="alafiat-archive-meta">' . esc_html(implode(' · ', $facts)) . '</p>' : '';
}

function alafiat_archive_title_facts($content, $block, $instance) {
    if (($block['attrs']['className'] ?? '') !== 'alafiat-archive-title'
        || ($instance->context['postType'] ?? '') !== 'produk_maklon') {
        return $content;
    }

    return alafiat_product_card_meta((int) ($instance->context['postId'] ?? 0)) . $content;
}
add_filter('render_block_core/post-title', 'alafiat_archive_title_facts', 10, 3);

function alafiat_get_related_products($post_id) {
    $terms = get_the_terms($post_id, 'kategori_sediaan');
    $args = array(
        'post_type' => 'produk_maklon',
        'post_status' => 'publish',
        'has_password' => false,
        'numberposts' => 3,
        'exclude' => array($post_id),
        'orderby' => array('date' => 'DESC', 'ID' => 'DESC'),
    );
    $related = array();

    if ($terms && !is_wp_error($terms)) {
        $related = get_posts(array_merge($args, array(
            'tax_query' => array(array(
                'taxonomy' => 'kategori_sediaan',
                'field' => 'term_id',
                'terms' => wp_list_pluck($terms, 'term_id'),
            )),
        )));
    }

    // Use other catalog products when the current category has fewer than three.
    if (count($related) < 3) {
        $args['numberposts'] -= count($related);
        $args['exclude'] = array_merge($args['exclude'], wp_list_pluck($related, 'ID'));
        $related = array_merge($related, get_posts($args));
    }

    return $related;
}

function alafiat_render_related_products($post_id) {
    $products = alafiat_get_related_products($post_id);
    if (!$products) {
        return;
    }
    ?>
    <section class="alafiat-product-related" aria-labelledby="alafiat-related-title">
        <h2 id="alafiat-related-title">Produk Terkait</h2>
        <ul class="alafiat-archive-grid">
            <?php foreach ($products as $product) :
                $title = get_the_title($product);
                $url = get_permalink($product);
                $photo = alafiat_product_photo($product->ID);
                $summary = $product->post_excerpt ?: excerpt_remove_blocks(strip_shortcodes($product->post_content));
                $summary = wp_trim_words($summary, 28);
                ?>
                <li>
                    <?php if ($photo !== '') : ?>
                        <figure class="alafiat-archive-photo"><?php echo $photo; ?></figure>
                    <?php endif; ?>
                    <article class="alafiat-archive-info">
                        <?php echo alafiat_product_card_meta($product->ID); ?>
                        <h3 class="alafiat-archive-title"><?php echo esc_html($title); ?></h3>
                        <?php if ($summary !== '') : ?>
                            <p class="alafiat-archive-excerpt"><?php echo esc_html($summary); ?></p>
                        <?php endif; ?>
                        <a class="alafiat-archive-arrow" href="<?php echo esc_url($url); ?>" aria-label="<?php echo esc_attr('Lihat produk: ' . $title); ?>"></a>
                    </article>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <?php
}

/**
 * Render the product body with its configured sediaan data.
 */
function alafiat_single_produk_content($content) {
    if (!is_singular('produk_maklon') || !in_the_loop() || !is_main_query()) {
        return $content;
    }

    $post_id = get_the_ID();
    $category = get_post_meta($post_id, '_alafiat_sediaan_key', true);
    $specs = array(
        'Izin' => get_post_meta($post_id, '_alafiat_izin', true),
        'MOQ' => get_post_meta($post_id, '_alafiat_moq', true),
        'Kemasan' => get_post_meta($post_id, '_alafiat_kemasan', true),
        'Jalur' => get_post_meta($post_id, '_alafiat_jalur', true),
    );
    $has_gallery = array_key_exists($category, alafiat_product_photo_files());
    $photo = alafiat_product_photo($post_id, $has_gallery ? 'preview-main-img' : '');

    $number = preg_replace('/\D/', '', (string) get_option('alafiat_whatsapp_number', '6281234567890'));
    $message = 'Halo Tim Al Afiat, saya ingin konsultasi ' . wp_strip_all_tags(get_the_title($post_id)) . '.';
    $whatsapp_url = $number !== '' ? 'https://wa.me/' . $number . '?text=' . rawurlencode($message) : '';

    ob_start();
    ?>
    <div class="alafiat-single-product"<?php if ($has_gallery) : ?> data-alafiat-product-category="<?php echo esc_attr($category); ?>"<?php endif; ?>>
      <div class="alafiat-product-view">
        <?php if ($photo !== '') : ?>
            <div class="alafiat-product-media">
                <figure id="preview-stage" class="alafiat-single-photo"><?php echo $photo; ?></figure>
                <?php if ($has_gallery) : ?>
                    <p id="preview-caption" class="text-xs text-inkMuted" aria-live="polite"></p>
                    <div id="preview-thumbs" class="alafiat-product-thumbnails" role="group" aria-label="Galeri produk"></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="alafiat-single-info">
            <div class="alafiat-single-description"><?php echo $content; ?></div>
            <dl class="alafiat-single-specs">
                <?php foreach (array_filter($specs) as $label => $value) : ?>
                    <div>
                        <dt><?php echo esc_html($label); ?></dt>
                        <dd><?php echo esc_html($value); ?></dd>
                    </div>
                <?php endforeach; ?>
            </dl>
            <?php if ($has_gallery) : ?>
                <div id="varian-produk" class="alafiat-product-variants" hidden>
                    <h2 id="preview-concept-label">Konsep Varian</h2>
                    <div id="preview-concept-picker" role="group" aria-labelledby="preview-concept-label"></div>
                    <p id="preview-concept-description" aria-live="polite"></p>
                </div>
            <?php endif; ?>
            <div class="alafiat-product-actions">
                <?php if ($whatsapp_url !== '') : ?>
                    <a href="<?php echo esc_url($whatsapp_url); ?>" id="preview-wa-cta" target="_blank" rel="noopener noreferrer" class="alafiat-product-cta">Konsultasi Maklon</a>
                <?php endif; ?>
            </div>
        </div>
      </div>
        <?php if ($has_gallery) : ?>
            <section class="alafiat-catalog-details" hidden>
                <h2 class="type-h3 text-ink">Kemasan &amp; Kontrol Mutu</h2>
                <ul id="preview-details-list" class="alafiat-catalog-detail-list"></ul>
            </section>
        <?php endif; ?>
        <?php if ($whatsapp_url !== '') : ?>
            <section class="alafiat-product-consultation" aria-labelledby="alafiat-consultation-title">
                <div>
                    <h2 id="alafiat-consultation-title">Siap mulai produksi?</h2>
                    <p>Diskusikan formula, kemasan, dan jumlah produksi dengan tim Al Afiat.</p>
                </div>
                <a href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" rel="noopener noreferrer" class="alafiat-product-cta">Konsultasi via WhatsApp</a>
            </section>
        <?php endif; ?>
        <?php alafiat_render_related_products($post_id); ?>
    </div>
    <?php
    return ob_get_clean();
}
add_filter('the_content', 'alafiat_single_produk_content');
