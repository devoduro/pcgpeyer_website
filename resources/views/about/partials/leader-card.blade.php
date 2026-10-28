{{-- One past leader card. Expects $minister and $loop from the caller's @foreach. --}}
<div class="group" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg hover:border-pcg-blue-200 transition-all duration-300 h-full">
        <div class="relative h-56 overflow-hidden">
            @if($minister->image)
                <img src="{{ asset('storage/' . $minister->image) }}" alt="{{ $minister->name }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            @else
                <img src="{{ asset('images/avatar-placeholder.png') }}" alt="{{ $minister->name }}"
                     class="w-full h-full object-cover">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
            @if($minister->service_duration)
                <div class="absolute bottom-3 left-3 text-white">
                    <div class="bg-pcg-blue-700/90 px-2 py-1 rounded text-xs font-medium">{{ $minister->service_duration }}</div>
                </div>
            @endif
        </div>
        <div class="p-4">
            <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-pcg-blue-700 transition-colors duration-300">{{ $minister->name }}</h3>
            <p class="text-pcg-blue-600 font-medium text-sm mb-1">{{ $minister->displayTitle }}</p>
            <p class="text-gray-600 text-xs mb-3">{{ $minister->yearRange }}</p>
            @if($minister->bio)
                <p class="text-gray-700 text-xs leading-relaxed">{{ Str::limit($minister->bio, 120) }}</p>
            @endif
        </div>
    </div>
</div>
