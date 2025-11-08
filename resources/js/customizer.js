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

    // Update homepage about section title in real-time
    wp.customize('homepage_about_title', function(value) {
        value.bind(function(newVal) {
            $('.section .text-content h2').text(newVal);
        });
    });

    // Update homepage about section first paragraph in real-time
    wp.customize('homepage_about_paragraph1', function(value) {
        value.bind(function(newVal) {
            $('.section .text-content p:first-of-type').text(newVal);
        });
    });

    // Update homepage about section second paragraph in real-time
    wp.customize('homepage_about_paragraph2', function(value) {
        value.bind(function(newVal) {
            $('.section .text-content p:last-of-type').text(newVal);
        });
    });

    // Update homepage about section button text in real-time
    wp.customize('homepage_about_button_text', function(value) {
        value.bind(function(newVal) {
            $('.learn-more-button a').text(newVal);
        });
    });

    // Update homepage about section image in real-time
    wp.customize('homepage_about_image', function(value) {
        value.bind(function(newVal) {
            if (newVal) {
                // Get the URL of the new image
                wp.media.attachment(newVal).fetch().then(function(attachment) {
                    var imageContainer = $('.section .content-grid-2 > div:last-child');
                    imageContainer.html('<img src="' + attachment.url + '" alt="' + wp.customize('homepage_about_title').get() + '" class="w-full h-full object-cover rounded-lg">');
                });
            } else {
                // Fallback to placeholder
                var imageContainer = $('.section .content-grid-2 > div:last-child');
                imageContainer.html('<span class="text-small text-gray-500">Image Placeholder</span>');
            }
        });
    });

    // Update WhatsApp number in real-time
    wp.customize('whatsapp_number', function(value) {
        value.bind(function(newVal) {
            // Update all WhatsApp links
            $('a[href*="wa.me"], a[href*="api.whatsapp.com"]').each(function() {
                var currentHref = $(this).attr('href');
                var message = '';
                
                // Extract existing message from URL
                var messageMatch = currentHref.match(/text=([^&]*)/);
                if (messageMatch) {
                    message = messageMatch[1];
                } else {
                    message = encodeURIComponent(wp.customize('whatsapp_message').get());
                }
                
                // Clean the number and create new URL
                var cleanNumber = newVal.replace(/[^0-9+]/g, '');
                $(this).attr('href', 'https://wa.me/' + cleanNumber + '?text=' + message);
            });
            
            // Show/hide floating WhatsApp button based on number
            if (newVal) {
                $('.fixed.bottom-6.right-6').show();
            } else {
                $('.fixed.bottom-6.right-6').hide();
            }
        });
    });

    // Update WhatsApp message in real-time
    wp.customize('whatsapp_message', function(value) {
        value.bind(function(newVal) {
            // Update all WhatsApp links
            $('a[href*="wa.me"], a[href*="api.whatsapp.com"]').each(function() {
                var currentHref = $(this).attr('href');
                var number = '';
                
                // Extract existing number from URL
                var numberMatch = currentHref.match(/wa\.me\/([^?]*)/);
                if (numberMatch) {
                    number = numberMatch[1];
                } else {
                    number = wp.customize('whatsapp_number').get().replace(/[^0-9+]/g, '');
                }
                
                // Create new URL with updated message
                $(this).attr('href', 'https://wa.me/' + number + '?text=' + encodeURIComponent(newVal));
            });
        });
    });

    // Update CTA title in real-time
    wp.customize('cta_title', function(value) {
        value.bind(function(newVal) {
            $('.section-lg.bg-blue-900 h2').text(newVal);
        });
    });

    // Update CTA description in real-time
    wp.customize('cta_description', function(value) {
        value.bind(function(newVal) {
            $('.section-lg.bg-blue-900 p').text(newVal);
        });
    });

    // Update CTA button text in real-time
    wp.customize('cta_button_text', function(value) {
        value.bind(function(newVal) {
            $('.section-lg.bg-blue-900 a').text(newVal);
        });
    });
})(jQuery);