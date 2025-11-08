<!-- About Section -->
<section class="section">
  <div class="container-content">
    <div class="content-grid content-grid-2 items-center">
      <div>
        <div class="text-content">
          <h2 class="text-h2 font-display space-x-lg text-gray-900">{{ \App\get_homepage_about_title() }}</h2>
          <p class="text-body space-lg text-gray-600">
            {{ \App\get_homepage_about_paragraph1() }}
          </p>
          <p class="text-body space-lg text-gray-600">
            {{ \App\get_homepage_about_paragraph2() }}
          </p>
        </div>
        <div class="learn-more-button pt-8">
          <a
            href="{{ home_url('/about-us') }}"
            style="text-decoration: none"
            class="space-x-lg p-lg shiny-button rounded-lg bg-blue-900 font-semibold text-white transition-all duration-300 hover:bg-blue-800"
          >
            {{ \App\get_homepage_about_button_text() }}
          </a>
        </div>
      </div>
      <div class="flex h-96 items-center justify-center rounded-lg">
        @php
          $about_image_url = \App\get_homepage_about_image_url();
        @endphp
        @if($about_image_url)
          <img src="{{ $about_image_url }}" alt="{{ \App\get_homepage_about_title() }}" class="w-full h-full object-cover rounded-lg">
        @else
          <span class="text-small text-gray-500">Image Placeholder</span>
        @endif
      </div>
    </div>
  </div>
</section>
