{{-- One group executive: portrait, name, position. Expects $leader, and $loop from the caller's @foreach. --}}
<figure class="group card" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 75 }}">
    <div class="ratio-3x4 rounded-none">
        <img src="{{ $leader->photo_url }}" alt="{{ $leader->name }}" class="transition-transform duration-500 ease-out group-hover:scale-105" loading="lazy">
    </div>
    <figcaption class="p-4 text-center">
        <p class="font-bold text-ink-900 leading-snug">{{ $leader->name }}</p>
        @if ($leader->position)
            <p class="text-sm font-semibold text-accent-600 mt-0.5">{{ $leader->position }}</p>
        @endif
    </figcaption>
</figure>
