<?php
/**
 * Alafiat Maklon Herbal Theme Functions
 */
if (!defined('ABSPATH')) exit;

function alafiat_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
    
    // Editor styles
    add_editor_style('https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700&display=swap');
    add_editor_style('style.css');
}
add_action('after_setup_theme', 'alafiat_theme_setup');

/**
 * Enqueue scripts and styles for frontend
 */
function alafiat_theme_scripts() {
    wp_enqueue_style(
        'alafiat-theme-google-fonts',
        'https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'alafiat-theme-style',
        get_stylesheet_uri(),
        array(),
        '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'alafiat_theme_scripts');

/**
 * Load the editor typography.
 */
function alafiat_theme_block_editor_assets() {
    wp_enqueue_style(
        'alafiat-editor-fonts',
        'https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700&display=swap',
        array(),
        null
    );
}
add_action('enqueue_block_editor_assets', 'alafiat_theme_block_editor_assets');
