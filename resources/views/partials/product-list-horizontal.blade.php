@php
    $all_products = new WP_Query([
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

@if($all_products->have_posts())
    <div class="product-list-horizontal-container mx-auto">
        <div class="swiper product-list-swiper">
            <div class="swiper-wrapper" style="justify-content: center">
                @while($all_products->have_posts())
                    @php
                        $all_products->the_post();
                        $product_id = get_the_ID();
                        $product_icon = get_post_meta($product_id, '_product_icon', true);
                        $is_active = $product_id === $current_product_id;
                    @endphp
                    
                    <div class="swiper-slide">
                        <a href="{{ get_permalink() }}" class="product-list-item {{ $is_active ? 'active' : '' }}">
                            <div class="product-list-item-inner">
                                <div class="product-list-icon">
                                    <svg class="w-8 h-8 {{ $is_active ? 'text-blue-900' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        {!! \App\get_product_icon_svg($product_icon ?: 'building') !!}
                                    </svg>
                                </div>
                                <div class="product-list-content">
                                    <h3 class="product-list-title">{{ get_the_title() }}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                @endwhile
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    
    @php
        wp_reset_postdata();
    @endphp
@endif

<style>
.product-list-horizontal-container {
    padding: 3rem 0;
}

.product-list-swiper {
    padding: 0 2rem;
}

.product-list-swiper .swiper-slide {
    width: auto;
}

.product-list-swiper .swiper-button-next,
.product-list-swiper .swiper-button-prev {
    color: #9ca3af;
    background: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.product-list-swiper .swiper-button-next:after,
.product-list-swiper .swiper-button-prev:after {
    font-size: 18px;
}

.product-list-item {
    display: block;
    padding: 1.25rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    text-decoration: none;
    background: transparent;
    border: 2px solid transparent;
    aspect-ratio: 1/1;
    min-height: 80px;
    max-width: 120px;
}

.product-list-item:hover {
    background: #f3f4f6;
    transform: translateY(-2px);
}

.product-list-item.active {
    background: white;
    border-color: #1e3a8a;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.product-list-item-inner {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    height: 100%;
}

.product-list-icon {
    flex-shrink: 0;
    width: 48px;
    height: 48px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.product-list-item.active .product-list-icon {
    background: #1e3a8a;
}

.product-list-item.active .product-list-icon svg {
    color: white;
}

.product-list-content {
    flex: 1;
    min-width: 0;
    text-align: center;
}

.product-list-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1f2937;
    margin: 0;
    line-height: 1.3;
}

.product-list-item.active .product-list-title {
    color: #1e3a8a;
}

@media (max-width: 768px) {
    .product-list-swiper {
        padding: 0 1rem;
    }
    
    .product-list-swiper .swiper-button-next,
    .product-list-swiper .swiper-button-prev {
        width: 32px;
        height: 32px;
    }
    
    .product-list-swiper .swiper-button-next:after,
    .product-list-swiper .swiper-button-prev:after {
        font-size: 14px;
    }
    
    .product-list-item-inner {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
    
    .product-list-icon {
        width: 40px;
        height: 40px;
    }
    
    .product-list-icon svg {
        width: 1.5rem;
        height: 1.5rem;
    }
}
</style>