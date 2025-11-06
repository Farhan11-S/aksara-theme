<?php

/**
 * Theme Customizer functionality.
 */

namespace App;

use Illuminate\Support\Facades\Vite;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
add_action('customize_register', function ($wp_customize) {
    // Add a section for site branding
    $wp_customize->add_section('site_branding', [
        'title' => __('Site Branding', 'sage'),
        'description' => __('Customize your site title, logo, and other branding elements.', 'sage'),
        'priority' => 30,
    ]);

    // Add setting for site logo
    $wp_customize->add_setting('site_logo', [
        'default' => '',
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ]);

    // Add control for site logo
    $wp_customize->add_control(new \WP_Customize_Media_Control($wp_customize, 'site_logo', [
        'label' => __('Site Logo', 'sage'),
        'section' => 'site_branding',
        'mime_type' => 'image',
        'priority' => 10,
    ]));

    // Add setting for mobile site logo (optional)
    $wp_customize->add_setting('mobile_site_logo', [
        'default' => '',
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ]);

    // Add control for mobile site logo
    $wp_customize->add_control(new \WP_Customize_Media_Control($wp_customize, 'mobile_site_logo', [
        'label' => __('Mobile Site Logo (Optional)', 'sage'),
        'description' => __('If not set, the main site logo will be used on mobile devices.', 'sage'),
        'section' => 'site_branding',
        'mime_type' => 'image',
        'priority' => 20,
    ]));

    // Add setting for site tagline
    $wp_customize->add_setting('site_tagline', [
        'default' => get_bloginfo('description', 'display'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ]);

    // Add control for site tagline
    $wp_customize->add_control('site_tagline', [
        'label' => __('Site Tagline', 'sage'),
        'section' => 'site_branding',
        'type' => 'text',
        'priority' => 30,
    ]);

    // Add setting for hero title
    $wp_customize->add_setting('hero_title', [
        'default' => 'Grow With Us',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ]);

    // Add control for hero title
    $wp_customize->add_control('hero_title', [
        'label' => __('Hero Title', 'sage'),
        'section' => 'site_branding',
        'type' => 'text',
        'priority' => 40,
    ]);

    // Add setting for hero image
    $wp_customize->add_setting('hero_image', [
        'default' => '',
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ]);

    // Add control for hero image
    $wp_customize->add_control(new \WP_Customize_Media_Control($wp_customize, 'hero_image', [
        'label' => __('Hero Image', 'sage'),
        'section' => 'site_branding',
        'mime_type' => 'image',
        'priority' => 50,
    ]));

    // Add section for product display settings
    $wp_customize->add_section('product_display', [
        'title' => __('Product Display', 'sage'),
        'description' => __('Configure how products are displayed on homepage.', 'sage'),
        'priority' => 40,
    ]);

    // Add setting for products section title
    $wp_customize->add_setting('products_section_title', [
        'default' => 'Our Products',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ]);

    // Add control for products section title
    $wp_customize->add_control('products_section_title', [
        'label' => __('Products Section Title', 'sage'),
        'section' => 'product_display',
        'type' => 'text',
        'priority' => 10,
    ]);

    // Add setting for products section description
    $wp_customize->add_setting('products_section_description', [
        'default' => 'We provide comprehensive technology solutions tailored to your business needs',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ]);

    // Add control for products section description
    $wp_customize->add_control('products_section_description', [
        'label' => __('Products Section Description', 'sage'),
        'section' => 'product_display',
        'type' => 'textarea',
        'priority' => 20,
    ]);

    // Add setting for number of products to display
    $wp_customize->add_setting('products_count', [
        'default' => 4,
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ]);

    // Add control for number of products to display
    $wp_customize->add_control('products_count', [
        'label' => __('Number of Products to Display', 'sage'),
        'section' => 'product_display',
        'type' => 'number',
        'input_attrs' => [
            'min' => 1,
            'max' => 12,
            'step' => 1,
        ],
        'priority' => 30,
    ]);

    // Add setting for products order
    $wp_customize->add_setting('products_order', [
        'default' => 'menu_order',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ]);

    // Add control for products order
    $wp_customize->add_control('products_order', [
        'label' => __('Products Order', 'sage'),
        'section' => 'product_display',
        'type' => 'select',
        'choices' => [
            'menu_order' => __('Menu Order (Custom Order)', 'sage'),
            'date' => __('Date (Newest First)', 'sage'),
            'title' => __('Title (Alphabetical)', 'sage'),
            'rand' => __('Random', 'sage'),
        ],
        'priority' => 40,
    ]);

    // Add section for About Us page content
    $wp_customize->add_section('about_us_content', [
        'title' => __('About Us Page Content', 'sage'),
        'description' => __('Customize the Vision and Mission sections on the About Us page.', 'sage'),
        'priority' => 50,
    ]);

    // Add setting for About Us Vision title
    $wp_customize->add_setting('about_us_vision_title', [
        'default' => 'VISI',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ]);

    // Add control for About Us Vision title
    $wp_customize->add_control('about_us_vision_title', [
        'label' => __('Vision Title', 'sage'),
        'section' => 'about_us_content',
        'type' => 'text',
        'priority' => 10,
    ]);

    // Add setting for About Us Vision content
    $wp_customize->add_setting('about_us_vision_content', [
        'default' => 'Menjadi perusahaan penyedia jasa IT terdepan yang handal dan inovatif, mendorong transformasi digital melalui layanan pengembangan aplikasi, infrastruktur, keamanan sistem dan implementasi sistem yang terpercaya.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'postMessage',
    ]);

    // Add control for About Us Vision content
    $wp_customize->add_control('about_us_vision_content', [
        'label' => __('Vision Content', 'sage'),
        'section' => 'about_us_content',
        'type' => 'textarea',
        'priority' => 20,
    ]);

    // Add setting for About Us Mission title
    $wp_customize->add_setting('about_us_mission_title', [
        'default' => 'MISI',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ]);

    // Add control for About Us Mission title
    $wp_customize->add_control('about_us_mission_title', [
        'label' => __('Mission Title', 'sage'),
        'section' => 'about_us_content',
        'type' => 'text',
        'priority' => 30,
    ]);

    // Add setting for About Us Mission content
    $wp_customize->add_setting('about_us_mission_content', [
        'default' => 'Inovasi dan Kualitas: Mengembangkan solusi IT terkini dan berkualitas tinggi dalam proses transformasi digital secara efisien dan optimal. Keamanan Sistem: Menyediakan layanan keamanan aplikasi, data dan infrastruktur untuk melindungi aset digital pelanggan. Kepuasan Pelanggan: Menempatkan kepuasan pelanggan sebagai prioritas utama dengan memberikan layanan yang responsif dan proaktif. Kolaborasi dan Kemitraan: Membangun dan memelihara kemitraan strategis dengan perusahaan lain untuk menghadirkan solusi yang lebih komprehensif dan inovatif. Pengembangan Sumber Daya Manusia: Mendorong pengembangan profesional karyawan melalui program pengembangan keterampilan.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'postMessage',
    ]);

    // Add control for About Us Mission content
    $wp_customize->add_control('about_us_mission_content', [
        'label' => __('Mission Content', 'sage'),
        'section' => 'about_us_content',
        'type' => 'textarea',
        'priority' => 40,
    ]);

    // Add section for About Us Hero section
    $wp_customize->add_section('about_us_hero', [
        'title' => __('About Us Hero Section', 'sage'),
        'description' => __('Customize the hero section on the About Us page.', 'sage'),
        'priority' => 45,
    ]);

    // Add setting for About Us hero subtitle
    $wp_customize->add_setting('about_us_hero_subtitle', [
        'default' => 'tentang kami',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ]);

    // Add control for About Us hero subtitle
    $wp_customize->add_control('about_us_hero_subtitle', [
        'label' => __('Hero Subtitle', 'sage'),
        'section' => 'about_us_hero',
        'type' => 'text',
        'priority' => 10,
    ]);

    // Add setting for About Us hero title
    $wp_customize->add_setting('about_us_hero_title', [
        'default' => 'Kami terdepan dalam solusi digitalisasi',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ]);

    // Add control for About Us hero title
    $wp_customize->add_control('about_us_hero_title', [
        'label' => __('Hero Title', 'sage'),
        'section' => 'about_us_hero',
        'type' => 'text',
        'priority' => 20,
    ]);

    // Add setting for About Us hero description
    $wp_customize->add_setting('about_us_hero_description', [
        'default' => 'Lentera berdiri dan berkembang untuk menjawab tantangan tingginya laju digitalisasi di Indonesia. Kami meyakini bahwa inovasi teknologi bukan hanya sekedar alat bisnis, melainkan sebagai partner bisnis perusahaan.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'postMessage',
    ]);

    // Add control for About Us hero description
    $wp_customize->add_control('about_us_hero_description', [
        'label' => __('Hero Description', 'sage'),
        'section' => 'about_us_hero',
        'type' => 'textarea',
        'priority' => 30,
    ]);

    // Add setting for About Us hero image
    $wp_customize->add_setting('about_us_hero_image', [
        'default' => '',
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ]);

    // Add control for About Us hero image
    $wp_customize->add_control(new \WP_Customize_Media_Control($wp_customize, 'about_us_hero_image', [
        'label' => __('Hero Image', 'sage'),
        'section' => 'about_us_hero',
        'mime_type' => 'image',
        'priority' => 40,
    ]));
});

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script(
        'sage-customizer',
        asset('resources/js/customizer.js')->uri(),
        ['customize-preview'],
        null,
        true
    );
});

/**
 * Helper function to get the site logo URL.
 *
 * @return string
 */
function get_site_logo_url() {
    $logo_id = get_theme_mod('site_logo');
    
    if ($logo_id) {
        return wp_get_attachment_image_url($logo_id, 'full');
    }
    
    // Fallback to default logo
    return asset('resources/images/main-icon.png')->uri();
}

/**
 * Helper function to get the mobile site logo URL.
 *
 * @return string
 */
function get_mobile_site_logo_url() {
    $logo_id = get_theme_mod('mobile_site_logo');
    
    if ($logo_id) {
        return wp_get_attachment_image_url($logo_id, 'full');
    }
    
    // Fallback to main logo
    return get_site_logo_url();
}

/**
 * Helper function to get the site tagline.
 *
 * @return string
 */
function get_site_tagline() {
    return get_theme_mod('site_tagline', get_bloginfo('description', 'display'));
}

/**
 * Helper function to get the hero title.
 *
 * @return string
 */
function get_hero_title() {
    return get_theme_mod('hero_title', 'Grow With Us');
}

/**
 * Helper function to get the hero image URL.
 *
 * @return string
 */
function get_hero_image_url() {
    $image_id = get_theme_mod('hero_image');
    
    if ($image_id) {
        return wp_get_attachment_image_url($image_id, 'full');
    }
    
    // Fallback to default hero image
    return asset('resources/images/lentera-hero.png')->uri();
}

/**
 * Helper function to get products section title.
 *
 * @return string
 */
function get_products_section_title() {
    return get_theme_mod('products_section_title', 'Our Products');
}

/**
 * Helper function to get products section description.
 *
 * @return string
 */
function get_products_section_description() {
    return get_theme_mod('products_section_description', 'We provide comprehensive technology solutions tailored to your business needs');
}

/**
 * Helper function to get products count.
 *
 * @return int
 */
function get_products_count() {
    return get_theme_mod('products_count', 6);
}

/**
 * Helper function to get products order.
 *
 * @return string
 */
function get_products_order() {
    return get_theme_mod('products_order', 'menu_order');
}

/**
 * Helper function to get About Us Vision title.
 *
 * @return string
 */
function get_about_us_vision_title() {
    return get_theme_mod('about_us_vision_title', 'VISI');
}

/**
 * Helper function to get About Us Vision content.
 *
 * @return string
 */
function get_about_us_vision_content() {
    return get_theme_mod('about_us_vision_content', 'Menjadi perusahaan penyedia jasa IT terdepan yang handal dan inovatif, mendorong transformasi digital melalui layanan pengembangan aplikasi, infrastruktur, keamanan sistem dan implementasi sistem yang terpercaya.');
}

/**
 * Helper function to get About Us Mission title.
 *
 * @return string
 */
function get_about_us_mission_title() {
    return get_theme_mod('about_us_mission_title', 'MISI');
}

/**
 * Helper function to get About Us Mission content.
 *
 * @return string
 */
function get_about_us_mission_content() {
    return get_theme_mod('about_us_mission_content', 'Inovasi dan Kualitas: Mengembangkan solusi IT terkini dan berkualitas tinggi dalam proses transformasi digital secara efisien dan optimal. Keamanan Sistem: Menyediakan layanan keamanan aplikasi, data dan infrastruktur untuk melindungi aset digital pelanggan. Kepuasan Pelanggan: Menempatkan kepuasan pelanggan sebagai prioritas utama dengan memberikan layanan yang responsif dan proaktif. Kolaborasi dan Kemitraan: Membangun dan memelihara kemitraan strategis dengan perusahaan lain untuk menghadirkan solusi yang lebih komprehensif dan inovatif. Pengembangan Sumber Daya Manusia: Mendorong pengembangan profesional karyawan melalui program pengembangan keterampilan.');
}

/**
 * Helper function to get About Us hero subtitle.
 *
 * @return string
 */
function get_about_us_hero_subtitle() {
    return get_theme_mod('about_us_hero_subtitle', 'tentang kami');
}

/**
 * Helper function to get About Us hero title.
 *
 * @return string
 */
function get_about_us_hero_title() {
    return get_theme_mod('about_us_hero_title', 'Kami terdepan dalam solusi digitalisasi');
}

/**
 * Helper function to get About Us hero description.
 *
 * @return string
 */
function get_about_us_hero_description() {
    return get_theme_mod('about_us_hero_description', 'Lentera berdiri dan berkembang untuk menjawab tantangan tingginya laju digitalisasi di Indonesia. Kami meyakini bahwa inovasi teknologi bukan hanya sekedar alat bisnis, melainkan sebagai partner bisnis perusahaan.');
}

/**
 * Helper function to get About Us hero image URL.
 *
 * @return string
 */
function get_about_us_hero_image_url() {
    $image_id = get_theme_mod('about_us_hero_image');
    
    if ($image_id) {
        return wp_get_attachment_image_url($image_id, 'full');
    }
    
    // Fallback to default hero image
    return Vite::asset('resources/images/lentera-hero.png');
}