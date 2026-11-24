<?php
/**
 * Gutenberg pattern for the Al Afiat homepage.
 */
if (!defined('ABSPATH')) {
    exit;
}

function alafiat_get_visual_landing_blocks() {
    $pattern = ALAFIAT_CORE_DIR . 'patterns/landing.html';
    if (!is_readable($pattern)) {
        error_log('Alafiat: landing pattern is unavailable.');
        return '';
    }

    $markup = file_get_contents($pattern);
    if ($markup === false) {
        error_log('Alafiat: landing pattern could not be read.');
        return '';
    }

    $company = esc_html((string) get_option('alafiat_company_name', 'CV Al Afiat Sehat Alami'));
    $company_attribute = serialize_block_attributes(array('content' => $company));
    return strtr($markup, array(
        '"content":"__ALAFIAT_COMPANY_RICH_TEXT__"' => substr($company_attribute, 1, -1),
        '__ALAFIAT_COMPANY_HTML__' => $company,
        '__ALAFIAT_FACTORY_ADDRESS__' => esc_html((string) get_option('alafiat_factory_address', 'Magelang, Jawa Tengah')),
        '__ALAFIAT_YEAR__' => wp_date('Y'),
    ));
}

function alafiat_register_landing_pattern() {
    register_block_pattern('alafiat/landing-page', array(
        'title' => 'Beranda Pabrik Maklon Herbal',
        'description' => 'Hero, katalog sediaan, jalur maklon, simulasi, proses, FAQ, dan footer.',
        'categories' => array('alafiat-maklon'),
        'postTypes' => array('page'),
        'filePath' => ALAFIAT_CORE_DIR . 'patterns/landing.php',
    ));
}
add_action('init', 'alafiat_register_landing_pattern', 20);
