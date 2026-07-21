@props([
    'sites' => collect([]),
    'height' => '500px',
    'zoom' => 10,
    'center' => ['lat' => -7.7956, 'lng' => 110.3695], // Default to Yogyakarta
    'interactive' => true,
])

@php
    $mapId = 'map-' . Str::random(8);
    $sitesData = $sites->map(function($site) {
        return [
            'id' => $site->id,
            'name' => $site->name,
            'slug' => $site->slug,
            'address' => $site->address,
            'latitude' => $site->latitude,
            'longitude' => $site->longitude,
            'category' => $site->category?->name ?? __('Other'),
            'url' => url('/heritage-sites/' . $site->slug),
        ];
    })->values()->all();
@endphp

<div 
    x-data="{}"
    x-init='window.initLeafletMap("{{ $mapId }}", {{ $interactive ? 'true' : 'false' }}, @js($center), {{ $zoom }}, @js($sitesData), "{{ __('View Detail') }}", "{{ __('Other') }}")'
    id="{{ $mapId }}" 
    style="height: {{ $height }}; width: 100%;" 
    class="rounded-xl ring-1 ring-inset ring-gray-200 shadow-sm z-10" 
    wire:ignore>
</div>
