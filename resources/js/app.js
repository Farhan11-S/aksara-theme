import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

// Import Swiper
import Swiper from 'swiper';
import { Navigation, Pagination, Thumbs } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// Mobile menu functionality
document.addEventListener('DOMContentLoaded', function() {
  const mobileMenuButton = document.getElementById('mobileMenuButton');
  const mobileSidebar = document.getElementById('mobileSidebar');
  const mobileOverlay = document.getElementById('mobileOverlay');
  const closeSidebar = document.getElementById('closeSidebar');
  const mobileAboutToggle = document.getElementById('mobileAboutToggle');
  const mobileAboutSubmenu = document.getElementById('mobileAboutSubmenu');
  
  // Check if elements exist before adding event listeners
  if (!mobileMenuButton || !mobileSidebar || !mobileOverlay || !closeSidebar) {
    return;
  }
  
  // Toggle sidebar function
  function toggleSidebar() {
    const isOpen = mobileSidebar.classList.contains('sidebar-open');
    
    if (isOpen) {
      // Close sidebar
      mobileSidebar.classList.remove('sidebar-open');
      mobileOverlay.classList.remove('overlay-visible');
      mobileOverlay.classList.add('hidden');
      document.body.style.overflow = '';
    } else {
      // Open sidebar
      mobileSidebar.classList.add('sidebar-open');
      mobileOverlay.classList.remove('hidden');
      mobileOverlay.classList.add('overlay-visible');
      document.body.style.overflow = 'hidden';
    }
  }
  
  // Close sidebar function
  function closeMobileSidebar() {
    mobileSidebar.classList.remove('sidebar-open');
    mobileOverlay.classList.remove('overlay-visible');
    mobileOverlay.classList.add('hidden');
    document.body.style.overflow = '';
  }
  
  // Open/close sidebar with hamburger button
  mobileMenuButton.addEventListener('click', function(e) {
    e.stopPropagation();
    toggleSidebar();
  });
  
  // Close sidebar events
  closeSidebar.addEventListener('click', function(e) {
    e.stopPropagation();
    closeMobileSidebar();
  });
  
  mobileOverlay.addEventListener('click', function(e) {
    e.stopPropagation();
    closeMobileSidebar();
  });
  
  // Close sidebar when clicking on navigation links
  const sidebarLinks = mobileSidebar.querySelectorAll('a');
  sidebarLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      setTimeout(() => {
        closeMobileSidebar();
      }, 150);
    });
  });
  
  // Toggle mobile About Us submenu
  if (mobileAboutToggle && mobileAboutSubmenu) {
    mobileAboutToggle.addEventListener('click', function(e) {
      e.stopPropagation();
      mobileAboutSubmenu.classList.toggle('hidden');
      const arrow = mobileAboutToggle.querySelector('svg');
      arrow.classList.toggle('rotate-180');
    });
  }
  
  // Close sidebar on escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && mobileSidebar.classList.contains('sidebar-open')) {
      closeMobileSidebar();
    }
  });
  
  // Prevent sidebar from closing when clicking inside it
  mobileSidebar.addEventListener('click', function(e) {
    e.stopPropagation();
  });
});

// Initialize Swiper carousels
document.addEventListener('DOMContentLoaded', function() {
  // Product List Horizontal Swiper
  const productListSwiper = document.querySelector('.product-list-swiper');
  if (productListSwiper) {
    new Swiper(productListSwiper, {
      modules: [Navigation],
      slidesPerView: 'auto',
      spaceBetween: 16,
      navigation: {
        nextEl: '.product-list-swiper .swiper-button-next',
        prevEl: '.product-list-swiper .swiper-button-prev',
      },
      breakpoints: {
        320: {
          slidesPerView: 1.2,
          spaceBetween: 12,
        },
        480: {
          slidesPerView: 2.2,
          spaceBetween: 12,
        },
        640: {
          slidesPerView: 3.2,
          spaceBetween: 16,
        },
        768: {
          slidesPerView: 4.2,
          spaceBetween: 16,
        },
        1024: {
          slidesPerView: 5.2,
          spaceBetween: 20,
        },
        1280: {
          slidesPerView: 6.2,
          spaceBetween: 20,
        },
      },
    });
  }

  // Product Image Carousel with Thumbnail Navigation
  const productImageCarousel = document.querySelector('.product-image-carousel');
  const productThumbnailCarousel = document.querySelector('.product-thumbnail-carousel');
  
  if (productImageCarousel && productThumbnailCarousel) {
    const thumbnailSwiper = new Swiper(productThumbnailCarousel, {
      modules: [Navigation],
      spaceBetween: 10,
      slidesPerView: 'auto',
      freeMode: true,
      watchSlidesProgress: true,
      breakpoints: {
        320: {
          slidesPerView: 3,
        },
        480: {
          slidesPerView: 4,
        },
        640: {
          slidesPerView: 5,
        },
        768: {
          slidesPerView: 6,
        },
        1024: {
          slidesPerView: 8,
        },
      },
    });

    new Swiper(productImageCarousel, {
      modules: [Navigation, Pagination, Thumbs],
      spaceBetween: 10,
      navigation: {
        nextEl: '.product-image-carousel .swiper-button-next',
        prevEl: '.product-image-carousel .swiper-button-prev',
      },
      pagination: {
        el: '.product-image-carousel .swiper-pagination',
        clickable: true,
      },
      thumbs: {
        swiper: thumbnailSwiper,
      },
    });
  }
});
