<?php
/**
 * Editable rich text and controls for markup that core blocks cannot express.
 */
if (!defined('ABSPATH')) {
    exit;
}

function alafiat_register_landing_element() {
    $script = 'alafiat-landing-element-editor';
    wp_register_script(
        $script,
        ALAFIAT_CORE_URL . 'assets/js/alafiat-landing-editor.js',
        array('wp-blocks', 'wp-block-editor', 'wp-components', 'wp-element', 'wp-hooks'),
        '1.0.2',
        true
    );

    $settings = array(
        'apiVersion' => 3,
        'title' => 'Teks dan Kontrol Maklon',
        'category' => 'design',
        'icon' => 'editor-textcolor',
        'attributes' => array(
            'tagName' => array('type' => 'string', 'enum' => array('span', 'div', 'dt', 'dd', 'a', 'button'), 'default' => 'span'),
            'content' => array('type' => 'string', 'default' => ''),
            'anchor' => array('type' => 'string'),
            'className' => array('type' => 'string'),
            'href' => array('type' => 'string'),
            'accessibleLabel' => array('type' => 'string'),
            'whatsappSource' => array('type' => 'string'),
            'whatsappMessage' => array('type' => 'string'),
            'control' => array('type' => 'object'),
        ),
        'supports' => array('html' => false, 'className' => false, 'inserter' => false, 'anchor' => true),
    );

    wp_add_inline_script($script, 'window.alafiatLandingElement = ' . wp_json_encode($settings) . ';', 'before');
    register_block_type('alafiat/landing-element', array_merge($settings, array(
        'editor_script' => $script,
        'render_callback' => 'alafiat_render_landing_element',
    )));
}
add_action('init', 'alafiat_register_landing_element');

function alafiat_render_landing_element($attributes) {
    $tag = $attributes['tagName'] ?? 'span';
    if (!in_array($tag, array('span', 'div', 'dt', 'dd', 'a', 'button'), true)) {
        return '';
    }

    $properties = array(
        'id' => $attributes['anchor'] ?? '',
        'class' => $attributes['className'] ?? '',
    );
    $control = $attributes['control'] ?? array();
    $allowed_properties = array('aria-hidden');
    if ($tag === 'button') {
        $properties['type'] = 'button';
        $allowed_properties = array_merge($allowed_properties, array(
            'aria-pressed', 'aria-selected', 'aria-expanded', 'aria-controls',
            'data-tab-filter', 'data-sim-group', 'data-sim-value',
        ));
    }
    foreach ($allowed_properties as $name) {
        if (isset($control[$name]) && is_string($control[$name])) {
            $properties[$name] = $control[$name];
        }
    }

    if ($tag === 'a') {
        $properties['href'] = esc_url_raw($attributes['href'] ?? '');
        $properties['aria-label'] = $attributes['accessibleLabel'] ?? '';
        if (!empty($attributes['whatsappSource'])) {
            $number = preg_replace('/\D/', '', (string) get_option('alafiat_whatsapp_number', '6281234567890'));
            $message = $attributes['whatsappMessage'] ?? '';
            if ($number !== '') {
                $properties['href'] = 'https://wa.me/' . $number;
                if ($message !== '') {
                    $properties['href'] = add_query_arg('text', rawurlencode($message), $properties['href']);
                    $properties['data-wa-message'] = $message;
                }
                $properties['data-wa-cta'] = sanitize_key($attributes['whatsappSource']);
            }
        }
    }

    $markup = '<' . $tag;
    foreach ($properties as $name => $value) {
        if ($value !== '') {
            $markup .= ' ' . $name . '="' . esc_attr($value) . '"';
        }
    }

    // Rich text in an action stays inline so it cannot create nested controls.
    $inline = array_fill_keys(array('span', 'strong', 'b', 'em', 'i', 'br', 's', 'sub', 'sup'), array());
    $inline['span'] = array('class' => true, 'aria-hidden' => true);
    return $markup . '>' . wp_kses($attributes['content'] ?? '', $inline) . '</' . $tag . '>';
}

function alafiat_render_landing_group($content, $block) {
    $classes = preg_split('/\s+/', $block['attrs']['className'] ?? '', -1, PREG_SPLIT_NO_EMPTY);
    $categories = array('madu', 'kapsul', 'susu', 'minyak', 'lainnya');
    foreach ($categories as $category) {
        if (in_array('alafiat-category-' . $category, $classes, true)) {
            $processor = new WP_HTML_Tag_Processor($content);
            if ($processor->next_tag(array('tag_name' => 'ARTICLE', 'class_name' => 'sediaan-card'))) {
                $processor->set_attribute('data-category', $category);
            }
            return $processor->get_updated_html();
        }
    }
    if (in_array('alafiat-sediaan-filters', $classes, true)) {
        $processor = new WP_HTML_Tag_Processor($content);
        if ($processor->next_tag(array('class_name' => 'alafiat-sediaan-filters'))) {
            $processor->set_attribute('role', 'group');
            $processor->set_attribute('aria-label', 'Filter bentuk sediaan');
        }
        return $processor->get_updated_html();
    }
    if (in_array('alafiat-portfolio-grid', $classes, true)) {
        $processor = new WP_HTML_Tag_Processor($content);
        if ($processor->next_tag(array('class_name' => 'alafiat-portfolio-grid'))) {
            $processor->set_attribute('role', 'region');
            $processor->set_attribute('aria-label', 'Daftar portofolio dan testimoni');
            $processor->set_attribute('tabindex', '0');
        }
        return $processor->get_updated_html();
    }
    if (in_array('alafiat-cert-grid', $classes, true)) {
        $processor = new WP_HTML_Tag_Processor($content);
        if ($processor->next_tag(array('class_name' => 'alafiat-cert-grid'))) {
            $processor->set_attribute('role', 'region');
            $processor->set_attribute('aria-label', 'Daftar sertifikat resmi pabrik');
            $processor->set_attribute('tabindex', '0');
        }
        return $processor->get_updated_html();
    }
    if (in_array('alafiat-cert-grid', $classes, true)) {
        $processor = new WP_HTML_Tag_Processor($content);
        if ($processor->next_tag(array('class_name' => 'alafiat-cert-grid'))) {
            $processor->set_attribute('role', 'region');
            $processor->set_attribute('aria-label', 'Daftar sertifikat resmi pabrik');
            $processor->set_attribute('tabindex', '0');
        }
        return $processor->get_updated_html();
    }
    return $content;
}
add_filter('render_block_core/group', 'alafiat_render_landing_group', 10, 2);
