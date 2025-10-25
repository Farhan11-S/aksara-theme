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

  <!-- Product Hero Section -->
  <section class="product-hero bg-gradient-to-br from-blue-50 to-white py-20">
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
    <section class="product-features py-16 bg-gray-50">
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
    <section class="product-image py-16 bg-white">
      <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
          <div class="rounded-lg overflow-hidden shadow-xl">
            {{ the_post_thumbnail('full', ['class' => 'w-full h-auto']) }}
          </div>
        </div>
      </div>
    </section>
  @endif

  <!-- Related Products Section -->
  @php
    $related_products = new WP_Query([
      'post_type' => 'product',
      'posts_per_page' => 3,
      'post__not_in' => [$product_id],
      'orderby' => 'rand',
    ]);
  @endphp
  
  @if($related_products->have_posts())
    <section class="related-products py-16 bg-gray-50">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">Related Products</h2>
          <p class="text-lg text-gray-600 max-w-2xl mx-auto">Explore our other solutions that might interest you</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
          @while($related_products->have_posts())
            @php
              $related_products->the_post();
              $related_subtitle = get_post_meta(get_the_ID(), '_product_subtitle', true);
              $related_icon = get_post_meta(get_the_ID(), '_product_icon', true);
            @endphp
            
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
              <div class="flex items-center justify-center mb-6">
                <div class="w-16 h-16 bg-blue-900 rounded-lg flex items-center justify-center">
                  <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! \App\get_product_icon_svg($related_icon ?: 'building') !!}
                  </svg>
                </div>
              </div>
              
              <h3 class="text-xl font-semibold text-gray-900 mb-3 text-center">{{ get_the_title() }}</h3>
              
              @if($related_subtitle)
                <p class="text-sm text-gray-500 mb-4 text-center">{{ $related_subtitle }}</p>
              @endif
              
              <div class="text-center">
                <a href="{{ get_permalink() }}" class="inline-block text-blue-900 hover:text-blue-800 font-semibold">
                  Learn More →
                </a>
              </div>
            </div>
          @endwhile
        </div>
      </div>
    </section>
    
    @php
        wp_reset_postdata();
    @endphp
  @endif
@endsection