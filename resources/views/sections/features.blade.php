@php
  $products = new WP_Query([
      'post_type' => 'product',
      'posts_per_page' => \App\get_products_count(),
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

<!-- Products Section -->
<section class="products-section bg-gray-50 section">
  <div class="container-content">
    <div class="text-center space-2xl">
      <h2 class="text-h2 font-display text-gray-900">{{ \App\get_products_section_title() }}</h2>
      <p class="text-body text-gray-600 max-w-2xl mx-auto leading-relaxed">{{ \App\get_products_section_description() }}</p>
    </div>

    @if ($products->have_posts())
      @php
        $product_count = $products->post_count;
      @endphp

      @include('partials.product-grid', ['products' => $products, 'count' => $product_count])
    @else
      @include('partials.fallback-products')
    @endif
  </div>
</section>

@php(wp_reset_postdata())

<style>
  /* Custom hover effects for product cards */
  .product-card:hover {
    background-color: #1e3a8a !important;
    color: white !important;
  }

  .product-card:hover h3,
  .product-card:hover p {
    color: white !important;
  }

  /* Custom hover effects for icon containers */
  .product-card:hover .icon-container {
    background-color: white !important;
    border: 2px solid #1e3a8a;
  }

  .product-card:hover .icon-container svg {
    color: #1e3a8a !important;
  }

  /* Custom hover effects for show more button */
  .product-card:hover .show-more-btn {
    background-color: white !important;
    border: 2px solid #1e3a8a;
  }

  .product-card:hover .show-more-btn svg {
    color: #1e3a8a !important;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .product-card {
      transform: none !important;
    }
  }
</style>
