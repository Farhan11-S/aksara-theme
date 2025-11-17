<header class="header bg-white shadow-md fixed top-0 left-0 right-0 z-50" id="header">
<style>
/* Custom styles for mobile sidebar */
.mobile-sidebar {
  transition: transform 0.3s ease-in-out;
  transform: translateX(100%);
}

.mobile-sidebar.sidebar-open {
  transform: translateX(0);
}

.mobile-overlay {
  transition: opacity 0.3s ease-in-out;
  opacity: 0;
}

.mobile-overlay.overlay-visible {
  opacity: 1;
}

/* Rotate 180 degrees for dropdown arrow */
.rotate-180 {
  transform: rotate(180deg);
}

/* Remove underline from all links */
.header a {
  text-decoration: none;
}

/* Active page styling */
.header .nav-active {
  color: #1e3a8a !important; /* blue-900 */
  font-weight: 600;
}

/* Mobile active page styling */
.mobile-sidebar .nav-active {
  background-color: #f3f4f6; /* gray-50 */
  color: #1e3a8a !important; /* blue-900 */
}

</style>
  @php
    $products = new WP_Query([
      'post_type' => 'product',
      'posts_per_page' => 1,
      'orderby' => \App\get_products_order(),
      'order' => 'ASC',
      'meta_query' => [
          [
              'key' => '_product_visible',
              'value' => '1',
              'compare' => '=',
          ],
      ],
    ]);
    $product_id = $products->have_posts() ? $products->posts[0]->ID : null;
  @endphp

  <div class="px-2 md:px-8">
    <div class="flex justify-between items-center h-24">
      <!-- Logo - Left -->
      <a class="brand flex items-center space-x-4 ml-2 md:ml-4" href="{{ home_url('/') }}">
        <img src="{{ \App\get_site_logo_url() }}" alt="{{ get_bloginfo('name', 'display') }}" class="w-16 h-16">
        <span class="text-h4 font-bold text-black hidden sm:block font-display">{{ get_bloginfo('name', 'display') }}</span>
        {{-- <span class="text-h4 font-bold text-black sm:hidden font-display">{{ substr(get_bloginfo('name', 'display'), 0, 1) . substr(str_replace(' ', '', get_bloginfo('name', 'display')), -2, 2) }}</span> --}}
      </a>

      <!-- Desktop Navigation - Center -->
      <nav class="hidden lg:flex absolute left-1/2 transform -translate-x-1/2 items-center">
        <div class="flex items-center space-x-10">
          <a href="{{ home_url('/') }}" class="text-body text-gray-700 hover:text-blue-900 transition-colors duration-300 font-semibold {{ request()->is('/') ? 'nav-active' : '' }}">Beranda</a>
          <a href="{{ get_permalink($product_id) }}" class="text-body text-gray-700 hover:text-blue-900 transition-colors duration-300 font-semibold {{ str_contains(request()->path(), 'products') ? 'nav-active' : '' }}">Produk</a>
          <a href="{{ home_url('/about-us') }}" class="text-body text-gray-700 hover:text-blue-900 transition-colors duration-300 font-semibold {{ str_contains(request()->path(), 'about-us') ? 'nav-active' : '' }}">Tentang Kami</a>
        </div>
      </nav>

      <!-- Hubungi Kami Button - Right (Desktop Only) -->
      <a href="{{ \App\get_whatsapp_url() }}" target="_blank" rel="noopener noreferrer" class="hidden lg:block shiny-button hubungi-button mr-2 md:mr-4 bg-blue-900 hover:bg-blue-800 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 text-body">
        Hubungi Kami
      </a>

      <!-- Mobile Menu Button - Right (Mobile/Tablet Only) -->
      <button class="lg:hidden text-black p-3 hover:bg-gray-100 rounded-lg transition-colors duration-200 hamburger-menu mr-2 md:mr-4" id="mobileMenuButton" aria-label="Toggle mobile menu">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>
  </div>
</header>

<!-- Mobile Sidebar Navigation -->
<div class="mobile-sidebar lg:hidden fixed top-0 right-0 h-full w-80 bg-white shadow-2xl z-50" id="mobileSidebar">
  <!-- Sidebar Header -->
  <div class="flex justify-between items-center p-4 border-b border-gray-200">
    <h2 class="text-lg font-semibold text-gray-900">Menu</h2>
    <button class="text-gray-500 hover:text-gray-700 p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200" id="closeSidebar" aria-label="Close mobile menu">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>
  </div>
  
  <!-- Sidebar Navigation -->
  <nav class="flex flex-col p-4 space-y-2">
    <a href="{{ home_url('/') }}" class="block px-4 py-3 text-body text-gray-700 hover:text-blue-900 hover:bg-gray-50 transition-colors duration-200 rounded-lg font-medium {{ request()->is('/') ? 'nav-active' : '' }}">Home</a>
    <a href="{{ get_permalink($product_id) }}" class="block px-4 py-3 text-body text-gray-700 hover:text-blue-900 hover:bg-gray-50 transition-colors duration-200 rounded-lg font-medium {{ str_contains(request()->path(), 'products') ? 'nav-active' : '' }}">Products</a>
    <a href="{{ home_url('/about-us') }}" class="block px-4 py-3 text-body text-gray-700 hover:text-blue-900 hover:bg-gray-50 transition-colors duration-200 rounded-lg font-medium {{ str_contains(request()->path(), 'about-us') ? 'nav-active' : '' }}">About Us</a>
    
    <!-- Hubungi Kami Button -->
    <a href="{{ \App\get_whatsapp_url() }}" target="_blank" rel="noopener noreferrer" class="mt-6 shiny-button hubungi-button bg-blue-900 hover:bg-blue-800 text-white font-medium py-3 px-6 rounded-lg transition-all duration-300 text-body text-center">
      Hubungi Kami
    </a>
  </nav>
</div>

<!-- Overlay for mobile sidebar -->
<div class="mobile-overlay lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden" id="mobileOverlay"></div>
