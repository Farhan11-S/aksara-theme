@extends('layouts.app')

@section('content')
  @php
    global $post;
    $product_id = $post->ID;
    $product_subtitle = get_post_meta($product_id, '_product_subtitle', true);
    $product_icon = get_post_meta($product_id, '_product_icon', true);
    $product_features = \App\get_product_features($product_id);
    $product_features_layout = get_post_meta($product_id, '_product_features_layout', true) ?: 'left';
    $product_software_preview = get_post_meta($product_id, '_product_software_preview', true);
    $product_button_text = get_post_meta($product_id, '_product_button_text', true);
    $product_button_url = get_post_meta($product_id, '_product_button_url', true);
  @endphp

  <!-- Product List Section -->
  <section class="product-list-section bg-white py-20">
    <div class="container px-4 bg-blue-50 py-8 max-w-[80%] mx-auto rounded-lg">
      <div class="max-w-6xl mx-auto">
        <div class="mb-8">
          <div class="company-name relative inline-block text-black text-xl font-light tracking-wider mb-2 opacity-70 ml-5">
            <span class="dot dot-left absolute top-1/2 left-[-20px] w-2 h-2 bg-black rounded-full transform -translate-y-1/2"></span>
            Produk Aksara
            <span class="dot dot-right absolute top-1/2 right-[-20px] w-2 h-2 bg-black rounded-full transform -translate-y-1/2"></span>
          </div>
          <h2 class="text-2xl font-bold text-black">Teknologi untuk penuhi kebutuhan bisnis modern</h2>
        </div>
        
        <div class="flex-1 mx-auto">
          @include('partials.product-list-horizontal', ['current_product_id' => $product_id])
        </div>
      </div>
    </div>
  </section>

  <!-- Product Hero Section -->
  <section class="product-hero bg-white py-16">
    <div class="container mx-auto px-4">
      <div class="max-w-6xl mx-auto">
        <div class="grid md:grid-cols-2 gap-12 items-center">
          @if($product_features_layout === 'left')
            <!-- Left Column - Features Text -->
            <div class="space-y-6">
              @if(!empty($product_features))
                <div class="prose prose-lg max-w-none text-gray-700">
                  {!! $product_features !!}
                </div>
              @else
                <!-- Default features if none are set -->
                <div class="space-y-4">
                  <h3 class="text-xl font-bold text-gray-900">1. Transaksi Cepat & Tanpa Ribet</h3>
                  <p class="text-gray-700">Pelanggan cukup memesan dan membayar langsung lewat sistem yang terintegrasi.</p>
                </div>
                
                <div class="space-y-4">
                  <h3 class="text-xl font-bold text-gray-900">2. Minimalkan Human Error</h3>
                  <p class="text-gray-700">Semua transaksi tercatat otomatis, mengurangi kesalahan pencatatan manual.</p>
                </div>
                
                <div class="space-y-4">
                  <h3 class="text-xl font-bold text-gray-900">3. Laporan Real-Time & Akurat</h3>
                  <p class="text-gray-700">Pemilik usaha bisa memantau omzet, stok, dan transaksi langsung dari smartphone.</p>
                </div>
                
                <div class="space-y-4">
                  <h3 class="text-xl font-bold text-gray-900">4. Tampilan Modern & User-Friendly</h3>
                  <p class="text-gray-700">Mudah digunakan oleh kasir maupun pelanggan.</p>
                </div>
              @endif
            </div>
            
            <!-- Right Column - Title and Images -->
            <div class="space-y-6">
              <h1 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $product_subtitle }}</h1>
              
              <!-- Main Product Screenshot -->
              @if(has_post_thumbnail())
                <div class="rounded-lg overflow-hidden shadow-xl">
                  {{ the_post_thumbnail('full', ['class' => 'w-full h-auto']) }}
                </div>
              @endif
              
              <!-- Additional Product Images -->
              <div class="prose prose-lg max-w-none text-gray-700">
                {!! get_the_content() !!}
              </div>
              
              @if($product_button_text && $product_button_url)
                <a href="{{ $product_button_url }}" class="inline-block bg-blue-900 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-300">
                  {{ $product_button_text }}
                </a>
              @endif
            </div>
          @else
            <!-- Left Column - Title and Images -->
            <div class="space-y-6">
              <h1 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $product_subtitle }}</h1>
              
              <!-- Main Product Screenshot -->
              @if(has_post_thumbnail())
                <div class="rounded-lg overflow-hidden shadow-xl">
                  {{ the_post_thumbnail('full', ['class' => 'w-full h-auto']) }}
                </div>
              @endif
              
              <!-- Additional Product Images -->
              <div class="prose prose-lg max-w-none text-gray-700">
                {!! get_the_content() !!}
              </div>
              
              @if($product_button_text && $product_button_url)
                <a href="{{ $product_button_url }}" class="inline-block bg-blue-900 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-300">
                  {{ $product_button_text }}
                </a>
              @endif
            </div>
            
            <!-- Right Column - Features Text -->
            <div class="space-y-6">
              @if(!empty($product_features))
                <div class="prose prose-lg max-w-none text-gray-700">
                  {!! $product_features !!}
                </div>
              @else
                <!-- Default features if none are set -->
                <div class="space-y-4">
                  <h3 class="text-xl font-bold text-gray-900">1. Transaksi Cepat & Tanpa Ribet</h3>
                  <p class="text-gray-700">Pelanggan cukup memesan dan membayar langsung lewat sistem yang terintegrasi.</p>
                </div>
                
                <div class="space-y-4">
                  <h3 class="text-xl font-bold text-gray-900">2. Minimalkan Human Error</h3>
                  <p class="text-gray-700">Semua transaksi tercatat otomatis, mengurangi kesalahan pencatatan manual.</p>
                </div>
                
                <div class="space-y-4">
                  <h3 class="text-xl font-bold text-gray-900">3. Laporan Real-Time & Akurat</h3>
                  <p class="text-gray-700">Pemilik usaha bisa memantau omzet, stok, dan transaksi langsung dari smartphone.</p>
                </div>
                
                <div class="space-y-4">
                  <h3 class="text-xl font-bold text-gray-900">4. Tampilan Modern & User-Friendly</h3>
                  <p class="text-gray-700">Mudah digunakan oleh kasir maupun pelanggan.</p>
                </div>
              @endif
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>

  <!-- Software Preview Section -->
  <section class="software-preview py-16 bg-gray-50">
    <div class="container mx-auto px-4">
      <div class="max-w-6xl mx-auto">
        @if($product_features_layout !== 'left')
          <div class="text-left mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Software Preview</h2>
          </div>
        @endif
        <div class="grid md:grid-cols-2 gap-12 items-center">
          @php
            $software_gallery = \App\get_product_software_gallery($product_id);
            $gallery_count = count($software_gallery);
          @endphp
          
          @if($product_features_layout === 'left')
            <!-- Hero had features on left, so software preview has content on right -->
            <!-- Left Column - Software Screenshots Gallery -->
            <div class="space-y-6">
              <div class="text-left mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Software Preview</h2>
              </div>
              @if(!empty($software_gallery))
                @if($gallery_count > 1)
                  <div class="swiper software-preview-carousel">
                    <div class="swiper-wrapper">
                      @foreach($software_gallery as $image)
                        <div class="swiper-slide">
                          <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}" class="w-full h-auto rounded-lg shadow-lg" />
                        </div>
                      @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                  </div>
                  
                  <!-- Thumbnail Navigation -->
                  <div class="swiper software-thumbnail-carousel mt-4">
                    <div class="swiper-wrapper">
                      @foreach($software_gallery as $image)
                        <div class="swiper-slide">
                          <img src="{{ $image['thumbnail'] }}" alt="{{ $image['alt'] }}" class="w-full h-auto rounded cursor-pointer" />
                        </div>
                      @endforeach
                    </div>
                  </div>
                @else
                  <!-- Single image display -->
                  <div class="rounded-lg overflow-hidden shadow-xl">
                    <img src="{{ $software_gallery[0]['url'] }}" alt="{{ $software_gallery[0]['alt'] }}" class="w-full h-auto" />
                  </div>
                @endif
              @else
                <!-- Fallback to featured image if no gallery images -->
                @if(has_post_thumbnail())
                  <div class="rounded-lg overflow-hidden shadow-xl">
                    {{ the_post_thumbnail('full', ['class' => 'w-full h-auto']) }}
                  </div>
                @endif
              @endif
            </div>
            
            <!-- Right Column - Software Preview Content -->
            <div class="space-y-6">
              @if(!empty($product_software_preview))
                <div class="prose prose-lg max-w-none text-gray-700">
                  {!! $product_software_preview !!}
                </div>
              @endif
            </div>
          @else
            <!-- Hero had features on right, so software preview has content on left -->
            <!-- Left Column - Software Preview Content -->
            <div class="space-y-6">
              @if(!empty($product_software_preview))
                <div class="prose prose-lg max-w-none text-gray-700">
                  {!! $product_software_preview !!}
                </div>
              @else
                <div class="prose prose-lg max-w-none text-gray-700">
                  {!! get_the_content() !!}
                </div>
              @endif
            </div>
            
            <!-- Right Column - Software Screenshots Gallery -->
            <div class="space-y-6">
              @if(!empty($software_gallery))
                @if($gallery_count > 1)
                  <div class="text-left mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">Software Preview</h2>
                  </div>
                  <div class="swiper software-preview-carousel">
                    <div class="swiper-wrapper">
                      @foreach($software_gallery as $image)
                        <div class="swiper-slide">
                          <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}" class="w-full h-auto rounded-lg shadow-lg" />
                        </div>
                      @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                  </div>
                  
                  <!-- Thumbnail Navigation -->
                  <div class="swiper software-thumbnail-carousel mt-4">
                    <div class="swiper-wrapper">
                      @foreach($software_gallery as $image)
                        <div class="swiper-slide">
                          <img src="{{ $image['thumbnail'] }}" alt="{{ $image['alt'] }}" class="w-full h-auto rounded cursor-pointer" />
                        </div>
                      @endforeach
                    </div>
                  </div>
                @else
                  <!-- Single image display -->
                  <div class="rounded-lg overflow-hidden shadow-xl">
                    <img src="{{ $software_gallery[0]['url'] }}" alt="{{ $software_gallery[0]['alt'] }}" class="w-full h-auto" />
                  </div>
                @endif
              @else
                <!-- Fallback to featured image if no gallery images -->
                @if(has_post_thumbnail())
                  <div class="rounded-lg overflow-hidden shadow-xl">
                    {{ the_post_thumbnail('full', ['class' => 'w-full h-auto']) }}
                  </div>
                @endif
              @endif
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>

  <style>
  .software-preview-carousel {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  }

  .software-preview-carousel .swiper-slide {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f9fafb;
  }

  .software-preview-carousel .swiper-slide img {
    max-height: 400px;
    object-fit: contain;
  }

  .software-preview-carousel .swiper-button-next,
  .software-preview-carousel .swiper-button-prev {
    color: #1e3a8a;
    background: rgba(255, 255, 255, 0.8);
    width: 44px;
    height: 44px;
    border-radius: 50%;
    margin-top: -22px;
  }

  .software-preview-carousel .swiper-button-next:after,
  .software-preview-carousel .swiper-button-prev:after {
    font-size: 20px;
  }

  .software-preview-carousel .swiper-pagination-bullet {
    background: #d1d5db;
    opacity: 1;
  }

  .software-preview-carousel .swiper-pagination-bullet-active {
    background: #1e3a8a;
  }

  .software-thumbnail-carousel {
    padding: 0 40px;
  }

  .software-thumbnail-carousel .swiper-slide {
    opacity: 0.6;
    transition: opacity 0.3s ease;
    cursor: pointer;
    border-radius: 8px;
    overflow: hidden;
    border: 2px solid transparent;
  }

  .software-thumbnail-carousel .swiper-slide-thumb-active {
    opacity: 1;
    border-color: #1e3a8a;
  }

  .software-thumbnail-carousel img {
    max-height: 80px;
    object-fit: cover;
    width: 100%;
  }

  @media (max-width: 768px) {
    .software-preview-carousel .swiper-button-next,
    .software-preview-carousel .swiper-button-prev {
      width: 36px;
      height: 36px;
      margin-top: -18px;
    }
    
    .software-preview-carousel .swiper-button-next:after,
    .software-preview-carousel .swiper-button-prev:after {
      font-size: 16px;
    }
    
    .software-thumbnail-carousel {
      padding: 0 30px;
    }
    
    .software-thumbnail-carousel img {
      max-height: 60px;
    }
  }
  </style>

  <!-- Product Carousel Section -->
  @include('partials.product-carousel', ['product_id' => $product_id])

  <!-- Footer Section -->
  @include('sections.footer')
@endsection