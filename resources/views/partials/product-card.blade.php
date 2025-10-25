<div class="group product-card bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105 {{ $width_class }}" @if($transform) style="transform: {{ $transform }};" @endif>
  <div class="flex items-center justify-between mb-6">
    <div class="icon-container w-16 h-16 bg-blue-900 rounded-lg flex items-center justify-center transition-all duration-300 group-hover:bg-white group-hover:border-2 group-hover:border-blue-900">
      <svg class="w-8 h-8 text-white transition-all duration-300 group-hover:text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        {!! \App\get_product_icon_svg($product_icon ?: 'building') !!}
      </svg>
    </div>
    <a href="{{ get_permalink($product_id) }}" class="show-more-btn w-16 h-16 bg-blue-900 rounded-lg flex items-center justify-center transition-all duration-300">
      <svg class="w-6 h-6 text-white transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
      </svg>
    </a>
  </div>
  <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-white">{{ get_the_title($product_id) }}</h3>
  @if($product_subtitle)
    <p class="text-sm text-gray-500 mb-2 group-hover:text-gray-200">{{ $product_subtitle }}</p>
  @endif
  <p class="text-gray-600 group-hover:text-gray-100">{{ get_the_excerpt($product_id) }}</p>
</div>