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
            'category' => $site->category?->name ?? 'Lainnya',
            'url' => url('/heritage-sites/' . $site->slug),
        ];
    })->values()->all();
@endphp

<div id="{{ $mapId }}" style="height: {{ $height }}; width: 100%;" class="rounded-xl ring-1 ring-inset ring-gray-200 shadow-sm z-10" wire:ignore></div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', function () {
        // ... (rest of the JS)
        const map = L.map('{{ $mapId }}', {
            zoomControl: {{ $interactive ? 'true' : 'false' }},
            dragging: {{ $interactive ? 'true' : 'false' }},
            scrollWheelZoom: {{ $interactive ? 'true' : 'false' }},
        }).setView([{{ $center['lat'] }}, {{ $center['lng'] }}], {{ $zoom }});

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Define custom icon
        const defaultIcon = L.icon({
            iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
            iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
            shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Sites data
        const sites = @json($sitesData);

        const markers = [];

        // Add markers
        sites.forEach(site => {
            if (site.latitude && site.longitude) {
                const popupContent = `
                    <div class="p-1 min-w-[200px]">
                        <span class="inline-block px-2 py-0.5 mb-2 text-[10px] font-bold uppercase tracking-wider text-primary-700 bg-primary-100 rounded-sm">
                            ${site.category}
                        </span>
                        <h4 class="font-bold text-gray-900 mb-1 leading-tight">${site.name}</h4>
                        <p class="text-xs text-gray-500 mb-3 line-clamp-2">${site.address}</p>
                        <a href="${site.url}" class="inline-flex w-full justify-center items-center px-3 py-1.5 text-xs font-semibold text-white bg-primary-600 rounded hover:bg-primary-500 transition">
                            Lihat Detail
                        </a>
                    </div>
                `;

                const marker = L.marker([site.latitude, site.longitude], { icon: defaultIcon })
                    .bindPopup(popupContent)
                    .addTo(map);
                    
                markers.push(marker);
            }
        });

        // Auto-fit bounds if there are multiple markers
        if (markers.length > 1) {
            const group = new L.featureGroup(markers);
            map.fitBounds(group.getBounds(), { padding: [50, 50] });
        } else if (markers.length === 1) {
            map.setView(markers[0].getLatLng(), 15);
        }
        
        // Handle Livewire component updates (re-rendering map logic if necessary)
        // For simplicity, we use wire:ignore on the map container so it doesn't get destroyed
    });
</script>
@endpush
