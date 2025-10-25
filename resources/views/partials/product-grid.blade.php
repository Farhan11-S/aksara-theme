@php
  $index = 0;
  $useStagger = ($count % 4) === 0;

  $stagger = function ($i) {
    return $i % 2 === 0 ? 'translateY(-20px)' : 'translateY(20px)';
  };

  $cardData = function ($transform, $widthClass) {
    $product_id = get_the_ID();
    return [
      'product_id' => $product_id,
      'product_subtitle' => get_post_meta($product_id, '_product_subtitle', true),
      'product_icon' => get_post_meta($product_id, '_product_icon', true),
      'product_button_text' => get_post_meta($product_id, '_product_button_text', true),
      'product_button_url' => get_post_meta($product_id, '_product_button_url', true),
      'transform' => $transform,
      'width_class' => $widthClass,
    ];
  };
@endphp

<div class="flex flex-col items-center">
  <div class="mb-8 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
    @php $row_index = 0; @endphp
    @while ($products->have_posts())
      @php
        $products->the_post();
        $transform = $useStagger ? $stagger($index) : 'none';
        if ($useStagger) { $index++; }
        $row_index++;
      @endphp
      @include('partials.product-card', $cardData($transform, ''))
    @endwhile
  </div>
</div>