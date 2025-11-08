<footer class="bg-gray-900 text-white relative">
  <style>
    div a {
      text-decoration: none; !important;
    }
  </style>
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
      @php
        $products = new WP_Query([
          'post_type' => 'product',
          'posts_per_page' => -1,
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
      @endphp
      <div class="footer-middle text-left">
        <h3 class="text-xl font-semibold text-white mb-6">Produk Kami</h3>
        <ul class="space-y-3 text-lg">
          @if ($products->have_posts())
            @while ($products->have_posts())
              @php($products->the_post())
              <li><a href="{{ get_permalink() }}" class="text-gray-400 hover:text-white transition-colors duration-300">{{ get_the_title() . ' - ' . get_post_meta(get_the_ID(), '_product_subtitle', true) }}</a></li>
            @endwhile
          @endif
        </ul>
      </div>

      <!-- Right: Company Information -->
      <div class="footer-right text-left">
        <h3 class="text-xl font-semibold text-white mb-6">Informasi Perusahaan</h3>
        <div class="space-y-3 text-lg">
          <a href="{{ home_url('/about-us') }}" class="text-gray-400 hover:text-white transition-colors duration-300 block">Tentang Kami</a>
          <a href="{{ home_url('/privacy') }}" class="text-gray-400 hover:text-white transition-colors duration-300 block">Kebijakan Privasi</a>
          <a href="{{ \App\get_whatsapp_url() }}" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition-colors duration-300 block">Hubungi Kami</a>
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
