@extends('layouts.app')

@section('content')
  @php
    global $post;
    $product_id = $post->ID;
    $product_subtitle = get_post_meta($product_id, '_product_subtitle', true);
    $product_icon = get_post_meta($product_id, '_product_icon', true);
    $product_features = \App\get_product_features($product_id);
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
  <section class="product-hero bg-whtie">
    <div class="container mx-auto px-4">
      <div class="max-w-4xl mx-auto text-center">
        <div class="flex justify-center mb-8">
          <div class="w-24 h-24 bg-blue-900 rounded-2xl flex items-center justify-center">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              {!! \App\get_product_icon_svg($product_icon ?: 'building') !!}
            </svg>
          </div>
        </div>
        
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">{{ get_the_title() }}</h1>
        
        @if($product_subtitle)
          <p class="text-xl text-gray-600 mb-8">{{ $product_subtitle }}</p>
        @endif
        
        <div class="prose prose-lg max-w-none text-gray-700 mb-12">
          {!! get_the_content() !!}
        </div>
        
        @if($product_button_text && $product_button_url)
          <a href="{{ $product_button_url }}" class="inline-block bg-blue-900 hover:bg-blue-800 text-white font-bold py-4 px-8 rounded-lg transition-colors duration-300 text-lg">
            {{ $product_button_text }}
          </a>
        @endif
      </div>
    </div>
  </section>

  <!-- Product Features Section -->
  @if(!empty($product_features))
    <section class="product-features py-16 bg-whtie">
      <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
          <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Key Features</h2>
          
          <div class="grid md:grid-cols-2 gap-8">
            @foreach($product_features as $feature)
              <div class="flex items-start space-x-4">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-900 rounded-full flex items-center justify-center mt-1">
                  <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <p class="text-gray-700 text-lg">{{ $feature }}</p>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
  @endif

  <!-- Product Image Section -->
  @if(has_post_thumbnail())
    <section class="product-image py-16 bg-whtie">
      <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
          <div class="rounded-lg overflow-hidden shadow-xl">
            {{ the_post_thumbnail('full', ['class' => 'w-full h-auto']) }}
          </div>
        </div>
      </div>
    </section>
  @endif

  <!-- Product Carousel Section -->
  @include('partials.product-carousel', ['product_id' => $product_id])

  <!-- Footer Section -->
  @include('sections.footer')
@endsection