@extends('layouts.app')

@section('content')
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
  @while(have_posts()) @php(the_post())
    <!-- Hero Section -->
    <section class="about-us-hero py-16 lg:py-24 bg-gray-50">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <div class="order-2 lg:order-1">
            <div class="mb-6">
              <h6 class="text-blue-900 font-semibold text-sm uppercase tracking-wider mb-4">{{ \App\get_about_us_hero_subtitle() }}</h6>
            </div>
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">{{ \App\get_about_us_hero_title() }}</h2>
            <div class="text-gray-600 leading-relaxed">
              <p>{{ \App\get_about_us_hero_description() }}</p>
            </div>
          </div>
          <div class="order-1 lg:order-2">
            <img src="{{ \App\get_about_us_hero_image_url() }}" alt="Lentera Office" class="rounded-lg w-full h-auto">
          </div>
        </div>
      </div>
    </section>

    <!-- Vision & Mission Section -->
    <section class="py-16 lg:py-24 bg-gradient-to-r from-blue-900 to-blue-800 text-white">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
          <!-- Vision -->
          <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-8">
            <h6 class="text-black font-semibold text-sm uppercase tracking-wider mb-4">VISI</h6>
            <p class="text-black leading-relaxed">Menjadi perusahaan penyedia jasa IT terdepan yang handal dan inovatif, mendorong transformasi digital melalui layanan pengembangan aplikasi, infrastruktur, keamanan sistem dan implementasi sistem yang terpercaya.</p>
          </div>
          
          <!-- Mission -->
          <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-8">
            <h6 class="text-black font-semibold text-sm uppercase tracking-wider mb-4">MISI</h6>
            <div class="text-black leading-relaxed">
              {!! \App\get_about_us_mission_content() !!}
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Additional Content Section -->
    <section class="py-16 lg:py-24 bg-gray-50">
      <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
          <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">Bergabunglah dengan Kami</h2>
          <p class="text-gray-600 text-lg leading-relaxed mb-8">
            Kami percaya bahwa tim yang solid adalah kunci kesuksesan dalam memberikan solusi terbaik bagi klien. 
            Bergabunglah dengan Lentera dan menjadi bagian dari perjalanan transformasi digital Indonesia.
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ get_permalink($product_id) }}" class="inline-flex items-center justify-center px-8 py-3 bg-blue-900 text-white font-semibold rounded-lg hover:bg-blue-800 transition-colors duration-300" style="text-decoration: none">
              Lihat Produk
            </a>
            <a href="{{ \App\get_whatsapp_url() }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-8 py-3 bg-white text-blue-900 font-semibold rounded-lg border-2 border-blue-900 hover:bg-blue-50 transition-colors duration-300" style="text-decoration: none">
              Hubungi Kami
            </a>
          </div>
        </div>
      </div>
    </section>
  @endwhile
@endsection

@section('footer')
  @include('sections.footer')
@endsection
