<!-- CTA Section -->
<section class="section-lg bg-blue-900 text-white">
  <div class="container-narrow text-center">
    <h2 class="text-display font-display text-white space-lg">{{ \App\get_cta_title() }}</h2>
    <p class="text-h4 text-blue-100 space-xl max-w-2xl mx-auto leading-relaxed">
      {{ \App\get_cta_description() }}
    </p>
    <a href="{{ \App\get_whatsapp_url() }}" target="_blank" rel="noopener noreferrer" class="bg-white text-blue-900 font-semibold p-lg rounded-lg hover:bg-gray-100 transition-all duration-300">
      {{ \App\get_cta_button_text() }}
    </a>
  </div>
</section>