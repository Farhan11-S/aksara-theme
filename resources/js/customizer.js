(function($) {
    // Update site logo in real-time
    wp.customize('site_logo', function(value) {
        value.bind(function(newVal) {
            if (newVal) {
                // Get the URL of the new logo
                wp.media.attachment(newVal).fetch().then(function(attachment) {
                    $('.brand img').attr('src', attachment.url);
                });
            } else {
                // Fallback to default logo
                $('.brand img').attr('src', window.location.origin + '/wp-content/themes/aksara-theme/resources/images/main-icon.png');
            }
        });
    });

    // Update mobile site logo in real-time
    wp.customize('mobile_site_logo', function(value) {
        value.bind(function(newVal) {
            if (newVal) {
                // Get the URL of the new mobile logo
                wp.media.attachment(newVal).fetch().then(function(attachment) {
                    // Update mobile logo if it's different from desktop
                    $('.brand img').attr('src', attachment.url);
                });
            } else {
                // Fallback to main logo
                var desktopLogo = wp.customize('site_logo').get();
                if (desktopLogo) {
                    wp.media.attachment(desktopLogo).fetch().then(function(attachment) {
                        $('.brand img').attr('src', attachment.url);
                    });
                } else {
                    $('.brand img').attr('src', window.location.origin + '/wp-content/themes/aksara-theme/resources/images/main-icon.png');
                }
            }
        });
    
        // Update products section title in real-time
        wp.customize('products_section_title', function(value) {
            value.bind(function(newVal) {
                $('.products-section h2').text(newVal);
            });
        });
    
        // Update products section description in real-time
        wp.customize('products_section_description', function(value) {
            value.bind(function(newVal) {
                $('.products-section .text-gray-600').text(newVal);
            });
        });
    });

    // Update site tagline in real-time
    wp.customize('site_tagline', function(value) {
        value.bind(function(newVal) {
            // Update tagline if it's displayed somewhere
            $('.site-tagline').text(newVal);
        });
    });

    // Update hero title in real-time
    wp.customize('hero_title', function(value) {
        value.bind(function(newVal) {
            $('.main-heading').text(newVal);
        });
    });

    // Update hero image in real-time
    wp.customize('hero_image', function(value) {
        value.bind(function(newVal) {
            if (newVal) {
                // Get the URL of the new hero image
                wp.media.attachment(newVal).fetch().then(function(attachment) {
                    $('.hero-image img').attr('src', attachment.url);
                });
            } else {
                // Fallback to default hero image
                $('.hero-image img').attr('src', window.location.origin + '/wp-content/themes/aksara-theme/resources/images/lentera-hero.png');
            }
        });
    });

    // Update About Us hero subtitle in real-time
    wp.customize('about_us_hero_subtitle', function(value) {
        value.bind(function(newVal) {
            $('.about-us-hero .text-blue-900').text(newVal);
        });
    });

    // Update About Us hero title in real-time
    wp.customize('about_us_hero_title', function(value) {
        value.bind(function(newVal) {
            $('.about-us-hero .text-gray-900').text(newVal);
        });
    });

    // Update About Us hero description in real-time
    wp.customize('about_us_hero_description', function(value) {
        value.bind(function(newVal) {
            $('.about-us-hero .text-gray-600 p').text(newVal);
        });
    });

    // Update About Us hero image in real-time
    wp.customize('about_us_hero_image', function(value) {
        value.bind(function(newVal) {
            if (newVal) {
                // Get the URL of the new hero image
                wp.media.attachment(newVal).fetch().then(function(attachment) {
                    $('.about-us-hero img').attr('src', attachment.url);
                });
            } else {
                // Fallback to default hero image
                $('.about-us-hero img').attr('src', window.location.origin + '/wp-content/themes/aksara-theme/resources/images/lentera-hero.png');
            }
        });
    });
})(jQuery);