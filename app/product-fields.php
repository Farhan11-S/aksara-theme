<?php

/**
 * Custom fields for products.
 */

namespace App;

/**
 * Add custom meta boxes for products.
 */
add_action('add_meta_boxes', function () {
    add_meta_box(
        'product_details',
        __('Product Details', 'sage'),
        function ($post) {
            // Add nonce for security
            wp_nonce_field('product_details_save', 'product_details_nonce');
            
            // Get current values
            $product_subtitle = get_post_meta($post->ID, '_product_subtitle', true);
            $product_icon = get_post_meta($post->ID, '_product_icon', true);
            $product_features = get_post_meta($post->ID, '_product_features', true);
            $product_button_text = get_post_meta($post->ID, '_product_button_text', true);
            $product_button_url = get_post_meta($post->ID, '_product_button_url', true);
            $product_visible = get_post_meta($post->ID, '_product_visible', true);
            $product_carousel_images = get_post_meta($post->ID, '_product_carousel_images', true);
            
            // Icon options
            $icon_options = [
                'building' => 'Building (ERP)',
                'lock' => 'Lock (BIONIC)',
                'star' => 'Star (PIMS)',
                'shopping-cart' => 'Shopping Cart (MATAPOS)',
                'cog' => 'Cog (Settings)',
                'chart-bar' => 'Chart Bar (Analytics)',
                'database' => 'Database',
                'cloud' => 'Cloud',
                'shield' => 'Shield (Security)',
                'mobile' => 'Mobile',
                'globe' => 'Globe',
            ];
            ?>
            <div class="product-fields">
                <div class="field-group">
                    <label for="product_subtitle"><?php _e('Product Subtitle', 'sage'); ?></label>
                    <input type="text" id="product_subtitle" name="product_subtitle" value="<?php echo esc_attr($product_subtitle); ?>" class="widefat">
                    <p class="description"><?php _e('Short description that appears under the product name', 'sage'); ?></p>
                </div>
                
                <div class="field-group">
                    <label for="product_icon"><?php _e('Product Icon', 'sage'); ?></label>
                    <select id="product_icon" name="product_icon" class="widefat">
                        <?php foreach ($icon_options as $value => $label) : ?>
                            <option value="<?php echo esc_attr($value); ?>" <?php selected($product_icon, $value); ?>>
                                <?php echo esc_html($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="description"><?php _e('Icon to display for this product', 'sage'); ?></p>
                </div>
                
                <div class="field-group">
                    <label for="product_features"><?php _e('Product Features', 'sage'); ?></label>
                    <textarea id="product_features" name="product_features" rows="4" class="widefat"><?php echo esc_textarea($product_features); ?></textarea>
                    <p class="description"><?php _e('List of key features (one per line)', 'sage'); ?></p>
                </div>
                
                <div class="field-group">
                    <label for="product_button_text"><?php _e('Button Text', 'sage'); ?></label>
                    <input type="text" id="product_button_text" name="product_button_text" value="<?php echo esc_attr($product_button_text); ?>" class="widefat">
                    <p class="description"><?php _e('Text for the call-to-action button', 'sage'); ?></p>
                </div>
                
                <div class="field-group">
                    <label for="product_button_url"><?php _e('Button URL', 'sage'); ?></label>
                    <input type="text" id="product_button_url" name="product_button_url" value="<?php echo esc_attr($product_button_url); ?>" class="widefat">
                    <p class="description"><?php _e('URL for the call-to-action button', 'sage'); ?></p>
                </div>
                
                <div class="field-group">
                    <label for="product_visible"><?php _e('Show on Homepage', 'sage'); ?></label>
                    <select id="product_visible" name="product_visible" class="widefat">
                        <option value="1" <?php selected($product_visible, '1'); ?>><?php _e('Yes', 'sage'); ?></option>
                        <option value="0" <?php selected($product_visible, '0'); ?>><?php _e('No', 'sage'); ?></option>
                    </select>
                    <p class="description"><?php _e('Whether to show this product on the homepage', 'sage'); ?></p>
                </div>
                
                <div class="field-group">
                    <label for="product_carousel_images"><?php _e('Product Carousel Images', 'sage'); ?></label>
                    <div id="product-carousel-images-container">
                        <div class="carousel-images-wrapper">
                            <?php
                            $carousel_images = $product_carousel_images ? explode(',', $product_carousel_images) : [];
                            if (!empty($carousel_images)) {
                                foreach ($carousel_images as $image_id) {
                                    if ($image_id) {
                                        $image_url = wp_get_attachment_image_url($image_id, 'thumbnail');
                                        echo '<div class="carousel-image-item" data-image-id="' . esc_attr($image_id) . '">';
                                        echo '<img src="' . esc_url($image_url) . '" alt="Carousel Image" />';
                                        echo '<button type="button" class="remove-carousel-image">×</button>';
                                        echo '</div>';
                                    }
                                }
                            }
                            ?>
                        </div>
                        <button type="button" id="add-carousel-image" class="button"><?php _e('Add Image', 'sage'); ?></button>
                        <input type="hidden" id="product_carousel_images" name="product_carousel_images" value="<?php echo esc_attr($product_carousel_images); ?>" />
                    </div>
                    <p class="description"><?php _e('Add multiple images for the product carousel', 'sage'); ?></p>
                </div>
            </div>
            
            <style>
                .product-fields .field-group {
                    margin-bottom: 15px;
                }
                .product-fields label {
                    display: block;
                    font-weight: bold;
                    margin-bottom: 5px;
                }
                .product-fields .description {
                    font-style: italic;
                    color: #666;
                    font-size: 12px;
                    margin-top: 5px;
                }
                .carousel-images-wrapper {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 10px;
                    margin-bottom: 10px;
                }
                .carousel-image-item {
                    position: relative;
                    width: 100px;
                    height: 100px;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    overflow: hidden;
                }
                .carousel-image-item img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
                .remove-carousel-image {
                    position: absolute;
                    top: 5px;
                    right: 5px;
                    background: #ff0000;
                    color: #fff;
                    border: none;
                    border-radius: 50%;
                    width: 20px;
                    height: 20px;
                    font-size: 12px;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
            </style>
            <?php
        },
        'product',
        'normal',
        'high'
    );
});

/**
 * Enqueue admin scripts for product fields.
 */
add_action('admin_enqueue_scripts', function ($hook) {
    global $post_type;
    
    if (($hook === 'post.php' || $hook === 'post-new.php') && $post_type === 'product') {
        wp_enqueue_media(); // Required for the media uploader
        wp_enqueue_script(
            'admin-product-fields',
            get_template_directory_uri() . '/resources/js/admin-product-fields.js',
            ['jquery'],
            '1.0.0',
            true
        );
    }
});

/**
 * Save product custom fields.
 */
add_action('save_post', function ($post_id) {
    // Check if our nonce is set.
    if (!isset($_POST['product_details_nonce'])) {
        return $post_id;
    }
    
    // Verify that the nonce is valid.
    if (!wp_verify_nonce($_POST['product_details_nonce'], 'product_details_save')) {
        return $post_id;
    }
    
    // Check this is the correct post type.
    if ('product' !== $_POST['post_type']) {
        return $post_id;
    }
    
    // Check user permissions.
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
    // Sanitize and save the fields.
    $fields = [
        'product_subtitle',
        'product_icon',
        'product_features',
        'product_button_text',
        'product_button_url',
        'product_visible',
        'product_carousel_images',
    ];
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            if ($field === 'product_carousel_images') {
                $value = sanitize_text_field($_POST[$field]);
            } else {
                $value = sanitize_text_field($_POST[$field]);
            }
            update_post_meta($post_id, '_' . $field, $value);
        }
    }
});

/**
 * Get product icon SVG.
 *
 * @param string $icon_name The icon name.
 * @return string The SVG markup.
 */
function get_product_icon_svg($icon_name) {
    $icons = [
        'building' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>',
        'lock' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>',
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>',
        'shopping-cart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>',
        'cog' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>',
        'chart-bar' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>',
        'database' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>',
        'cloud' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>',
        'shield' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>',
        'mobile' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>',
        'globe' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
    ];
    
    return isset($icons[$icon_name]) ? $icons[$icon_name] : $icons['building'];
}

/**
 * Get product features as array.
 *
 * @param int $post_id The product ID.
 * @return array The features list.
 */
function get_product_features($post_id) {
    $features = get_post_meta($post_id, '_product_features', true);
    if (empty($features)) {
        return [];
    }
    
    return array_filter(array_map('trim', explode("\n", $features)));
}

/**
 * Get product carousel images.
 *
 * @param int $post_id The product ID.
 * @return array The carousel images array with URLs.
 */
function get_product_carousel_images($post_id) {
    $carousel_images = get_post_meta($post_id, '_product_carousel_images', true);
    if (empty($carousel_images)) {
        return [];
    }
    
    $image_ids = explode(',', $carousel_images);
    $images = [];
    
    foreach ($image_ids as $image_id) {
        if ($image_id) {
            $image_url = wp_get_attachment_image_url($image_id, 'large');
            if ($image_url) {
                $images[] = [
                    'id' => $image_id,
                    'url' => $image_url,
                    'thumbnail' => wp_get_attachment_image_url($image_id, 'thumbnail'),
                    'alt' => get_post_meta($image_id, '_wp_attachment_image_alt', true) ?: get_the_title($image_id)
                ];
            }
        }
    }
    
    return $images;
}