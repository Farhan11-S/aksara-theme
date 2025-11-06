<?php

use Roots\Acorn\Application;

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__.'/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

Application::configure()
    ->withProviders([
        App\Providers\ThemeServiceProvider::class,
    ])
    ->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters', 'customizer', 'product-fields'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });

/**
 * Add custom template for About Us page.
 *
 * @param array $templates Array of template files.
 * @return array Modified array of template files.
 */
add_filter('theme_page_templates', function ($templates) {
    $templates['page-about-us.php'] = 'About Us Page';
    return $templates;
});

/**
 * Load custom template for About Us page.
 *
 * @param string $template The template path.
 * @return string The modified template path.
 */
add_filter('template_include', function ($template) {
    global $post;
    
    if (is_page() && get_page_template_slug() === 'page-about-us.php') {
        $theme_template = locate_template(['page-about-us.blade.php']);
        
        if ($theme_template) {
            return $theme_template;
        }
    }
    
    // Also check if the page slug is 'about-us'
    if (is_page() && $post->post_name === 'about-us') {
        $theme_template = locate_template(['page-about-us.blade.php']);
        
        if ($theme_template) {
            return $theme_template;
        }
    }
    
    return $template;
});

/**
 * Add rewrite rule for about-us page.
 *
 * @return void
 */
add_action('init', function () {
    add_rewrite_rule(
        '^about-us/?$',
        'index.php?pagename=about-us',
        'top'
    );
});

/**
 * Flush rewrite rules on theme activation.
 *
 * @return void
 */
add_action('after_switch_theme', function () {
    flush_rewrite_rules();
});
