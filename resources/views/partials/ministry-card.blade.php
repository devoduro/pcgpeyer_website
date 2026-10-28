{{-- One ministry in a listing grid. Expects $ministry, and $loop from the caller's @foreach. --}}
@php
    $details = array_filter([
        $ministry->meeting_schedule ? ['far fa-clock', 'Meets', $ministry->meeting_schedule] : null,
        $ministry->location ? ['fas fa-location-dot', 'Where', $ministry->location] : null,
        $ministry->leader ? ['fas fa-user', 'Leader', $ministry->leader] : null,
    ]);
@endphp
<a href="{{ route('ministries.show', $ministry->slug) }}"
   class="group card card-hover flex flex-col h-full"
   data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 120 }}">
    <div class="relative ratio-4x3 rounded-none">
        <img src="{{ $ministry->image_url }}" alt="{{ $ministry->name }}" class="transition-transform duration-700 ease-out group-hover:scale-110" loading="lazy">
        <div class="absolute inset-0 bg-gradient-to-t from-navy-950/90 via-navy-950/30 to-transparent"></div>
        <div class="absolute inset-x-0 bottom-0 p-5">
            @if ($ministry->ministry_category)
                <span class="badge bg-white/15 text-white backdrop-blur mb-2">{{ $ministry->ministry_category }}</span>
            @endif
            <h3 class="text-xl md:text-2xl font-extrabold text-white leading-tight">{{ $ministry->name }}</h3>
            @if ($ministry->age_range)
                <p class="text-sm text-white/75 mt-1">{{ $ministry->age_range }}</p>
            @endif
        </div>
    </div>

    <div class="flex flex-col flex-1 p-5 md:p-6">
        <p class="text-ink-600 leading-relaxed clamp-3 mb-5">{{ $ministry->description }}</p>

        @if ($details)
            <dl class="space-y-2.5 mb-6 text-sm">
                @foreach ($details as [$icon, $label, $value])
                    <div class="flex items-start gap-3">
                        <dt class="flex items-center gap-2 w-[70px] shrink-0 text-ink-400 font-semibold">
                            <i class="{{ $icon }} w-4 text-center text-accent-600"></i>{{ $label }}
                        </dt>
                        <dd class="text-ink-800 font-semibold">{{ $value }}</dd>
                    </div>
                @endforeach
            </dl>
        @endif

        <span class="mt-auto inline-flex items-center gap-2 font-bold text-brand-600 group-hover:text-accent-600 transition-colors">
            Learn more <i class="fas fa-arrow-right text-xs transition-transform duration-300 group-hover:translate-x-1"></i>
        </span>
    </div>
</a>
