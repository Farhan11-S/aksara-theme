@php
    $carousel_images = \App\get_product_carousel_images($product_id);
@endphp

@if(!empty($carousel_images))
    <section class="product-carousel-section py-16 bg-whtie">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="swiper product-image-carousel">
                    <div class="swiper-wrapper">
                        @foreach($carousel_images as $image)
                            <div class="swiper-slide">
                                <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}" class="w-full h-auto rounded-lg" />
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                
                <!-- Thumbnail Navigation -->
                <div class="swiper product-thumbnail-carousel mt-4">
                    <div class="swiper-wrapper">
                        @foreach($carousel_images as $image)
                            <div class="swiper-slide">
                                <img src="{{ $image['thumbnail'] }}" alt="{{ $image['alt'] }}" class="w-full h-auto rounded cursor-pointer" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<style>
.product-image-carousel {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.product-image-carousel .swiper-slide {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f9fafb;
}

.product-image-carousel .swiper-slide img {
    max-height: 500px;
    object-fit: contain;
}

.product-image-carousel .swiper-button-next,
.product-image-carousel .swiper-button-prev {
    color: #1e3a8a;
    background: rgba(255, 255, 255, 0.8);
    width: 44px;
    height: 44px;
    border-radius: 50%;
    margin-top: -22px;
}

.product-image-carousel .swiper-button-next:after,
.product-image-carousel .swiper-button-prev:after {
    font-size: 20px;
}

.product-image-carousel .swiper-pagination-bullet {
    background: #d1d5db;
    opacity: 1;
}

.product-image-carousel .swiper-pagination-bullet-active {
    background: #1e3a8a;
}

.product-thumbnail-carousel {
    padding: 0 40px;
}

.product-thumbnail-carousel .swiper-slide {
    opacity: 0.6;
    transition: opacity 0.3s ease;
    cursor: pointer;
    border-radius: 8px;
    overflow: hidden;
    border: 2px solid transparent;
}

.product-thumbnail-carousel .swiper-slide-thumb-active {
    opacity: 1;
    border-color: #1e3a8a;
}

.product-thumbnail-carousel img {
    max-height: 80px;
    object-fit: cover;
    width: 100%;
}

@media (max-width: 768px) {
    .product-image-carousel .swiper-button-next,
    .product-image-carousel .swiper-button-prev {
        width: 36px;
        height: 36px;
        margin-top: -18px;
    }
    
    .product-image-carousel .swiper-button-next:after,
    .product-image-carousel .swiper-button-prev:after {
        font-size: 16px;
    }
    
    .product-thumbnail-carousel {
        padding: 0 30px;
    }
    
    .product-thumbnail-carousel img {
        max-height: 60px;
    }
}
</style>