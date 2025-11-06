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
  <div class="px-2 md:px-8">
    <div class="flex justify-between items-center h-24">
      <!-- Logo - Left -->
      <a class="brand flex items-center space-x-4 ml-2 md:ml-4" href="{{ home_url('/') }}">
        <img src="{{ \App\get_site_logo_url() }}" alt="{{ get_bloginfo('name', 'display') }}" class="w-16 h-16">
        <span class="text-h4 font-bold text-black hidden sm:block font-display">{{ get_bloginfo('name', 'display') }}</span>
        <span class="text-h4 font-bold text-black sm:hidden font-display">{{ substr(get_bloginfo('name', 'display'), 0, 1) . substr(str_replace(' ', '', get_bloginfo('name', 'display')), -2, 2) }}</span>
      </a>

      <!-- Desktop Navigation - Center -->
      <nav class="hidden lg:flex absolute left-1/2 transform -translate-x-1/2 items-center">
        <div class="flex items-center space-x-10">
          <a href="{{ home_url('/') }}" class="text-body text-gray-700 hover:text-blue-900 transition-colors duration-300 font-semibold {{ request()->is('/') ? 'nav-active' : '' }}">Home</a>
          <a href="{{ home_url('/products') }}" class="text-body text-gray-700 hover:text-blue-900 transition-colors duration-300 font-semibold {{ str_contains(request()->path(), 'products') ? 'nav-active' : '' }}">Products</a>
          <a href="{{ home_url('/request-demo') }}" class="text-body text-gray-700 hover:text-blue-900 transition-colors duration-300 font-semibold {{ str_contains(request()->path(), 'request-demo') ? 'nav-active' : '' }}">Request Demo</a>
          <a href="{{ home_url('/customers') }}" class="text-body text-gray-700 hover:text-blue-900 transition-colors duration-300 font-semibold {{ str_contains(request()->path(), 'customers') ? 'nav-active' : '' }}">Customers</a>
          
          <!-- About Us Dropdown -->
          <div class="relative group">
            <button class="text-body text-gray-700 hover:text-blue-900 transition-colors duration-300 font-semibold flex items-center space-x-1">
              <span>About Us</span>
              <svg class="w-5 h-5 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            
            <!-- Dropdown Menu -->
            <div class="absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2 border border-gray-200 z-50">
              <a href="{{ home_url('/customer-support') }}" class="block px-4 py-3 text-body text-gray-700 hover:text-blue-900 hover:bg-gray-50 transition-colors duration-200 rounded-t-lg {{ str_contains(request()->path(), 'customer-support') ? 'nav-active' : '' }}">Customer Support</a>
              <a href="{{ home_url('/sales') }}" class="block px-4 py-3 text-body text-gray-700 hover:text-blue-900 hover:bg-gray-50 transition-colors duration-200 {{ str_contains(request()->path(), 'sales') ? 'nav-active' : '' }}">Sales</a>
              <a href="{{ home_url('/free-consultation') }}" class="block px-4 py-3 text-body text-gray-700 hover:text-blue-900 hover:bg-gray-50 transition-colors duration-200 rounded-b-lg {{ str_contains(request()->path(), 'free-consultation') ? 'nav-active' : '' }}">Free Consultation</a>
            </div>
          </div>
        </div>
      </nav>

      <!-- Hubungi Kami Button - Right (Desktop Only) -->
      <a href="{{ home_url('/contact') }}" class="hidden lg:block shiny-button hubungi-button mr-2 md:mr-4 {{ str_contains(request()->path(), 'contact') ? 'bg-blue-700' : 'bg-blue-900 hover:bg-blue-800' }} text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 text-body">
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
    <a href="{{ home_url('/products') }}" class="block px-4 py-3 text-body text-gray-700 hover:text-blue-900 hover:bg-gray-50 transition-colors duration-200 rounded-lg font-medium {{ str_contains(request()->path(), 'products') ? 'nav-active' : '' }}">Products</a>
    <a href="{{ home_url('/request-demo') }}" class="block px-4 py-3 text-body text-gray-700 hover:text-blue-900 hover:bg-gray-50 transition-colors duration-200 rounded-lg font-medium {{ str_contains(request()->path(), 'request-demo') ? 'nav-active' : '' }}">Request Demo</a>
    <a href="{{ home_url('/customers') }}" class="block px-4 py-3 text-body text-gray-700 hover:text-blue-900 hover:bg-gray-50 transition-colors duration-200 rounded-lg font-medium {{ str_contains(request()->path(), 'customers') ? 'nav-active' : '' }}">Customers</a>
    
    <!-- Mobile About Us Section -->
    <div class="border-t border-gray-200 pt-4 mt-2">
      <div class="px-4 py-3 text-gray-700 font-medium flex items-center justify-between cursor-pointer hover:bg-gray-50 rounded-lg transition-colors duration-200" id="mobileAboutToggle">
        <span>About Us</span>
        <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
      </div>
      <div class="mobile-submenu hidden pl-4 space-y-1 mt-2" id="mobileAboutSubmenu">
        <a href="{{ home_url('/customer-support') }}" class="block px-4 py-3 text-small text-gray-600 hover:text-blue-900 hover:bg-gray-50 transition-colors duration-200 rounded-lg {{ str_contains(request()->path(), 'customer-support') ? 'nav-active' : '' }}">Customer Support</a>
        <a href="{{ home_url('/sales') }}" class="block px-4 py-3 text-small text-gray-600 hover:text-blue-900 hover:bg-gray-50 transition-colors duration-200 rounded-lg {{ str_contains(request()->path(), 'sales') ? 'nav-active' : '' }}">Sales</a>
        <a href="{{ home_url('/free-consultation') }}" class="block px-4 py-3 text-small text-gray-600 hover:text-blue-900 hover:bg-gray-50 transition-colors duration-200 rounded-lg {{ str_contains(request()->path(), 'free-consultation') ? 'nav-active' : '' }}">Free Consultation</a>
      </div>
    </div>
    
    <!-- Hubungi Kami Button -->
    <a href="{{ home_url('/contact') }}" class="mt-6 shiny-button hubungi-button {{ str_contains(request()->path(), 'contact') ? 'bg-blue-700' : 'bg-blue-900 hover:bg-blue-800' }} text-white font-medium py-3 px-6 rounded-lg transition-all duration-300 text-body text-center">
      Hubungi Kami
    </a>
  </nav>
</div>

<!-- Overlay for mobile sidebar -->
<div class="mobile-overlay lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden" id="mobileOverlay"></div>
