<footer class="bg-gray-900 text-white relative">
  <div class="container mx-auto px-4 py-16">
    <!-- Main Footer Content -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Left: Icon with Site Name -->
      <div class="footer-left">
        <div class="flex items-center space-x-4">
          <img src="{{ \App\get_site_logo_url() }}" alt="{{ get_bloginfo('name', 'display') }}" class="w-10 h-10">
          <span class="text-2xl font-bold text-white">{{ get_bloginfo('name', 'display') }}</span>
        </div>
      </div>

      <!-- Middle: List of Products -->
      <div class="footer-middle text-left">
        <h3 class="text-xl font-semibold text-white mb-6">Produk Kami</h3>
        <ul class="space-y-3 text-lg">
          <li><a href="#erp" class="text-gray-400 hover:text-white transition-colors duration-300">ERP - Enterprise Resource Planning</a></li>
          <li><a href="#pims" class="text-gray-400 hover:text-white transition-colors duration-300">PIMS - Plantation Monitoring</a></li>
          <li><a href="#bionic" class="text-gray-400 hover:text-white transition-colors duration-300">BIONIC - Barrier Gate Control</a></li>
          <li><a href="#matapos" class="text-gray-400 hover:text-white transition-colors duration-300">MATAPOS - Point of Sale</a></li>
        </ul>
      </div>

      <!-- Right: Company Information -->
      <div class="footer-right text-left">
        <h3 class="text-xl font-semibold text-white mb-6">Informasi Perusahaan</h3>
        <div class="space-y-3 text-lg">
          <a href="#about" class="text-gray-400 hover:text-white transition-colors duration-300 block">Tentang Kami</a>
          <a href="#privacy" class="text-gray-400 hover:text-white transition-colors duration-300 block">Kebijakan Privasi</a>
          <a href="#contact" class="text-gray-400 hover:text-white transition-colors duration-300 block">Hubungi Kami</a>
        </div>
      </div>
    </div>

    <!-- Bottom Footer - Copyright Only -->
    <div class="border-t border-gray-800 mt-16 pt-8">
      <div class="text-center">
        <div class="text-gray-400 text-lg">
          © {{ date('Y') }} {{ get_bloginfo('name', 'display') }}. Hak Cipta Dilindungi.
        </div>
      </div>
    </div>
  </div>
</footer>
