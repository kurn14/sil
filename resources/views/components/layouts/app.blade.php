<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ??  __('Service Information System of BPK Region DIY') }}</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-50 min-h-screen flex flex-col">
        
        <!-- Navbar -->
        <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="/" class="flex items-center gap-2">
                                <x-heroicon-s-building-library class="w-8 h-8 text-primary-600" />
                                <span class="font-bold text-xl tracking-tight text-gray-900">BPK <span class="text-primary-600">DIY</span></span>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <a href="/" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out {{ request()->is('/') ? '!border-primary-500 !text-gray-900' : '' }}">
                                {{ __('Home') }}
                            </a>
                            <a href="/heritage-sites" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out {{ request()->is('heritage-sites*') ? '!border-primary-500 !text-gray-900' : '' }}">
                                {{ __('Cultural Heritage Site Catalog') }}
                            </a>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                        <!-- Language Switcher -->
                        <div class="relative group">
                            <button type="button" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700 font-medium">
                                <x-heroicon-m-language class="w-5 h-5" />
                                {{ strtoupper(app()->getLocale()) }}
                                <x-heroicon-s-chevron-down class="w-4 h-4" />
                            </button>
                            <div class="absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border border-gray-100">
                                <a href="/lang/id" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary-600 rounded-t-md {{ app()->getLocale() === 'id' ? 'bg-primary-50 text-primary-600' : '' }}">Indonesia (ID)</a>
                                <a href="/lang/en" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary-600 rounded-b-md {{ app()->getLocale() === 'en' ? 'bg-primary-50 text-primary-600' : '' }}">English (EN)</a>
                            </div>
                        </div>

                        @auth('applicant')
                            <a href="/applicant" class="text-sm text-gray-700 hover:text-gray-900 font-medium">{{ __('Applicant Panel') }}</a>
                        @else
                            <a href="/applicant/login" class="text-sm text-gray-700 hover:text-gray-900 font-medium">{{ __('Applicant Login') }}</a>
                        @endauth
                        <a href="/admin" class="text-sm bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition font-medium">{{ __('Admin') }}</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white mt-12 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <x-heroicon-s-building-library class="w-8 h-8 text-primary-400" />
                        <span class="font-bold text-xl tracking-tight">BPK <span class="text-primary-400">DIY</span></span>
                    </div>
                    <p class="text-gray-400 text-sm">
                        {!! __('Cultural Preservation Center Region X<br>Special Region of Yogyakarta and Central Java') !!}
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('Quick Links') }}</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="/" class="hover:text-white transition">{{ __('Home') }}</a></li>
                        <li><a href="/heritage-sites" class="hover:text-white transition">{{ __('Cultural Heritage Site Catalog') }}</a></li>
                        <li><a href="/applicant" class="hover:text-white transition">{{ __('Facility Usage') }}</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('Contact') }}</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>Jl. Ndalem Jayadipuran No. 13, Yogyakarta</li>
                        <li>Telp: (0274) 373682</li>
                        <li>Email: bpkdiy@kemdikbud.go.id</li>
                    </ul>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-gray-800 text-sm text-center text-gray-500">
                &copy; {{ date('Y') }} {{ __('Cultural Preservation Center Region X. All Rights Reserved.') }}
            </div>
        </footer>

        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        
        <script>
            (function() {
                function initMapFromElement(el) {
                    try {
                        const mapId = el.getAttribute('data-map-id');
                        if (!mapId) return;

                        // Check if map is already initialized on this container
                        if (el._leaflet_id) return;

                        const interactive = el.getAttribute('data-interactive') === 'true';
                        const center = JSON.parse(el.getAttribute('data-center') || '{"lat":-7.7956,"lng":110.3695}');
                        const zoom = parseInt(el.getAttribute('data-zoom') || '10', 10);
                        const sites = JSON.parse(el.getAttribute('data-sites') || '[]');
                        const viewDetailText = el.getAttribute('data-view-detail-text') || 'View Detail';
                        const otherText = el.getAttribute('data-other-text') || 'Other';

                        const map = L.map(mapId, {
                            zoomControl: interactive,
                            dragging: interactive,
                            scrollWheelZoom: interactive,
                        }).setView([center.lat, center.lng], zoom);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                        }).addTo(map);

                        const defaultIcon = L.icon({
                            iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
                            iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
                            shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
                            iconSize: [25, 41],
                            iconAnchor: [12, 41],
                            popupAnchor: [1, -34],
                            shadowSize: [41, 41]
                        });

                        const markers = [];

                        sites.forEach(site => {
                            if (site.latitude && site.longitude) {
                                const category = site.category || otherText;
                                const popupContent = `
                                    <div class="p-1 min-w-[200px]">
                                        <span class="inline-block px-2 py-0.5 mb-2 text-[10px] font-bold uppercase tracking-wider text-primary-700 bg-primary-100 rounded-sm">
                                            ${category}
                                        </span>
                                        <h4 class="font-bold text-gray-900 mb-1 leading-tight">${site.name}</h4>
                                        <p class="text-xs text-gray-500 mb-3 line-clamp-2">${site.address}</p>
                                        <a href="${site.url}" class="inline-flex w-full justify-center items-center px-3 py-1.5 text-xs font-semibold text-white bg-primary-600 rounded hover:bg-primary-500 transition">
                                            ${viewDetailText}
                                        </a>
                                    </div>
                                `;

                                const marker = L.marker([site.latitude, site.longitude], { icon: defaultIcon })
                                    .bindPopup(popupContent)
                                    .addTo(map);

                                markers.push(marker);
                            }
                        });

                        if (markers.length > 1) {
                            const group = new L.featureGroup(markers);
                            map.fitBounds(group.getBounds(), { padding: [50, 50] });
                        } else if (markers.length === 1) {
                            map.setView(markers[0].getLatLng(), 15);
                        }

                        // Fix map size after rendering — multiple attempts for dynamic containers
                        setTimeout(() => { map.invalidateSize(); }, 100);
                        setTimeout(() => { map.invalidateSize(); }, 500);
                    } catch (e) {
                        console.error('Leaflet init error:', e);
                    }
                }

                function initAllMaps() {
                    document.querySelectorAll('.leaflet-map-container').forEach(el => {
                        if (!el._leaflet_id) {
                            initMapFromElement(el);
                        }
                    });
                }

                // Initialize maps already on the page
                document.addEventListener('DOMContentLoaded', initAllMaps);

                // Watch for new map containers added dynamically (Livewire)
                const observer = new MutationObserver(mutations => {
                    for (const mutation of mutations) {
                        for (const node of mutation.addedNodes) {
                            if (node.nodeType !== 1) continue;
                            if (node.classList && node.classList.contains('leaflet-map-container')) {
                                initMapFromElement(node);
                            }
                            // Also check children
                            if (node.querySelectorAll) {
                                node.querySelectorAll('.leaflet-map-container').forEach(el => {
                                    if (!el._leaflet_id) {
                                        initMapFromElement(el);
                                    }
                                });
                            }
                        }
                    }
                });

                observer.observe(document.body, { childList: true, subtree: true });

                // Also hook into Livewire's morph lifecycle if available
                if (typeof Livewire !== 'undefined') {
                    document.addEventListener('livewire:navigated', initAllMaps);
                }
                document.addEventListener('livewire:init', () => {
                    Livewire.hook('morph.added', ({ el }) => {
                        if (el.classList && el.classList.contains('leaflet-map-container')) {
                            setTimeout(() => initMapFromElement(el), 50);
                        }
                        if (el.querySelectorAll) {
                            el.querySelectorAll('.leaflet-map-container').forEach(mapEl => {
                                if (!mapEl._leaflet_id) {
                                    setTimeout(() => initMapFromElement(mapEl), 50);
                                }
                            });
                        }
                    });
                });
            })();
        </script>

        @livewireScripts
        @stack('scripts')
    </body>
</html>
