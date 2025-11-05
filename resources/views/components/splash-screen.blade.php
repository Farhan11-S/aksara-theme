@vite(['resources/images/main-icon.png'])
<div id="splash-screen" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-white">
    <div class="mb-8">
        <img src="{{ Vite::asset('resources/images/main-icon.png') }}" alt="Site Icon" class="w-24 h-24 animate-pulse">
    </div>
    <div class="w-64 h-2 bg-gray-200 rounded-full overflow-hidden">
        <div id="loading-bar" class="h-full bg-blue-600 rounded-full transition-all duration-1000 ease-out" style="width: 0%"></div>
    </div>
</div>