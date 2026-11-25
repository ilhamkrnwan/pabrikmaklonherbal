<?php
/**
 * Plugin Name: Alafiat Maklon Herbal Core
 * Plugin URI: https://pabrikmaklonherbal.test/
 * Description: Sistem inti pabrik maklon herbal berstandar CPOTB BPOM: Custom Post Type produk maklon, kalkulator simulasi interaktif, product viewer, dan pengaturan WhatsApp dinamis.
 * Version: 1.0.0
 * Author: Antigravity & Al Afiat Engineering
 * Text Domain: alafiat-maklon
 */

if (!defined('ABSPATH')) exit;

define('ALAFIAT_CORE_FILE', __FILE__);
define('ALAFIAT_CORE_DIR', plugin_dir_path(__FILE__));
define('ALAFIAT_CORE_URL', plugin_dir_url(__FILE__));

// Load Modules
require_once ALAFIAT_CORE_DIR . 'includes/cpt.php';
require_once ALAFIAT_CORE_DIR . 'includes/settings.php';
require_once ALAFIAT_CORE_DIR . 'includes/patterns.php';
require_once ALAFIAT_CORE_DIR . 'includes/landing-elements.php';
require_once ALAFIAT_CORE_DIR . 'includes/landing-blocks.php';
require_once ALAFIAT_CORE_DIR . 'includes/seeder.php';

/**
 * Enqueue Frontend Styles and Scripts
 */
function alafiat_enqueue_assets() {
    // 1. Google Font Onest
    wp_enqueue_style(
        'alafiat-google-fonts',
        'https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    // 2. Core Alafiat CSS
    wp_enqueue_style(
        'alafiat-core-css',
        ALAFIAT_CORE_URL . 'assets/css/alafiat.css',
        array(),
        '1.0.4'
    );

    $is_block_landing = is_front_page() && has_block('alafiat/landing-element', get_queried_object_id());
    if ($is_block_landing) {
        wp_enqueue_style('alafiat-landing-utilities-css', ALAFIAT_CORE_URL . 'assets/css/alafiat-editor-utilities.css', array(), '1.0.1');
    }
    if (is_front_page()) {
        wp_enqueue_style(
            'alafiat-landing-css',
            ALAFIAT_CORE_URL . 'assets/css/alafiat-landing.css',
            $is_block_landing ? array('alafiat-core-css', 'alafiat-landing-utilities-css') : array('alafiat-core-css'),
            '1.4.2'
        );
    }

    if (is_page('produk') || is_post_type_archive('produk_maklon') || is_singular('produk_maklon')) {
        wp_enqueue_style(
            'alafiat-products-css',
            ALAFIAT_CORE_URL . 'assets/css/alafiat-products.css',
            array('alafiat-core-css'),
            '1.1.5'
        );
    }

    // 3. The legacy shortcode still uses Tailwind at runtime.
    if (!$is_block_landing && !is_post_type_archive('produk_maklon') && !is_singular('produk_maklon')) {
        wp_enqueue_script(
            'tailwind-cdn',
            'https://cdn.tailwindcss.com',
            array(),
            null,
            false
        );
    }

    // 4. Simulasi & Interactive Landing Page JS
    wp_enqueue_script(
        'alafiat-simulasi-js',
        ALAFIAT_CORE_URL . 'assets/js/alafiat-simulasi.js',
        array(),
        '1.2.0',
        true
    );

    // 5. Product Detail Viewer JS
    wp_enqueue_script(
        'alafiat-viewer-js',
        ALAFIAT_CORE_URL . 'assets/js/alafiat-viewer.js',
        array(),
        '1.2.2',
        true
    );

    // 6. GSAP & Smooth ScrollTrigger Animations
    wp_enqueue_script(
        'alafiat-gsap',
        ALAFIAT_CORE_URL . 'assets/vendor/gsap/gsap.min.js',
        array(),
        '3.15.1',
        true
    );

    wp_enqueue_script(
        'alafiat-gsap-scrolltrigger',
        ALAFIAT_CORE_URL . 'assets/vendor/gsap/ScrollTrigger.min.js',
        array('alafiat-gsap'),
        '3.15.1',
        true
    );

    wp_enqueue_script(
        'alafiat-animations-js',
        ALAFIAT_CORE_URL . 'assets/js/alafiat-animations.js',
        array('alafiat-gsap', 'alafiat-gsap-scrolltrigger', 'alafiat-simulasi-js'),
        '1.1.0',
        true
    );

    // Localize Configuration to JS
    $wa_number = get_option('alafiat_whatsapp_number', '6281234567890');
    $company   = get_option('alafiat_company_name', 'CV Al Afiat Sehat Alami');

    wp_localize_script('alafiat-simulasi-js', 'ALFIAT_CONFIG', array(
        'whatsappNumber' => $wa_number,
        'companyName'    => $company,
        'appendUtm'      => true,
    ));

    wp_localize_script('alafiat-viewer-js', 'ALFIAT_CONFIG', array(
        'whatsappNumber' => $wa_number,
        'companyName'    => $company,
        'appendUtm'      => true,
    ));
}
add_action('wp_enqueue_scripts', 'alafiat_enqueue_assets');

/**
 * Block assets are also collected for the iframe in the Site Editor.
 */
function alafiat_enqueue_landing_editor_assets() {
    if (!is_admin()) {
        return;
    }

    wp_enqueue_style('alafiat-editor-core-css', ALAFIAT_CORE_URL . 'assets/css/alafiat.css', array(), '1.0.3');
    wp_enqueue_style('alafiat-editor-products-css', ALAFIAT_CORE_URL . 'assets/css/alafiat-products.css', array('alafiat-editor-core-css'), '1.1.5');
    wp_enqueue_style('alafiat-editor-utilities-css', ALAFIAT_CORE_URL . 'assets/css/alafiat-editor-utilities.css', array(), '1.0.1');
    wp_enqueue_style(
        'alafiat-editor-landing-css',
        ALAFIAT_CORE_URL . 'assets/css/alafiat-landing.css',
        array('alafiat-editor-core-css', 'alafiat-editor-utilities-css'),
        '1.4.2'
    );
}
add_action('enqueue_block_assets', 'alafiat_enqueue_landing_editor_assets');

/**
 * Add custom body class
 */
function alafiat_body_classes($classes) {
    $classes[] = 'alafiat-body';
    return $classes;
}
add_filter('body_class', 'alafiat_body_classes');

/**
 * Auto seed check on admin init if not seeded
 */
function alafiat_maybe_seed_data() {
    if (is_admin() && !get_option('alafiat_data_seeded')) {
        alafiat_seed_data();
        update_option('alafiat_data_seeded', true);
    }
}
add_action('admin_init', 'alafiat_maybe_seed_data');
