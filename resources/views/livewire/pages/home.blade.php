<div>
    <!-- Hero Section -->
    <div class="relative bg-gray-900 overflow-hidden">
        <div class="absolute inset-0">
            <!-- You can replace this with a real image from storage later -->
            <img src="{{ asset('images/hero-borobudur.jpeg') }}" alt="Borobudur" class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32 flex flex-col items-center text-center">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary-500/10 text-primary-400 text-sm font-medium mb-6 ring-1 ring-inset ring-primary-500/20">
                <x-heroicon-s-sparkles class="w-4 h-4" />
                {{ __('Service Information System') }}
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white tracking-tight mb-6 leading-tight">
                {{ __('Explore & Preserve') }} <br class="hidden md:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-amber-300">{{ __('Our Cultural Heritage') }}</span>
            </h1>
            <p class="mt-4 text-lg md:text-xl text-gray-300 max-w-2xl mx-auto mb-10 leading-relaxed">
                {{ __('Find complete information on cultural heritage sites in D.I. Yogyakarta and apply for the use of cultural heritage facilities online.') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="/heritage-sites" class="inline-flex justify-center items-center gap-2 rounded-lg bg-primary-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 transition">
                    <x-heroicon-m-map class="w-5 h-5" />
                    {{ __('Explore Catalog') }}
                </a>
                <a href="/applicant" class="inline-flex justify-center items-center gap-2 rounded-lg bg-white/10 px-6 py-3 text-base font-semibold text-white backdrop-blur-sm ring-1 ring-inset ring-white/20 hover:bg-white/20 transition">
                    <x-heroicon-m-document-text class="w-5 h-5" />
                    {{ __('Apply for Facility') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-white py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-gray-600">{{ __('Registered Sites') }}</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">{{ $stats['total_sites'] }}</dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-gray-600">{{ __('Actively Visited Sites') }}</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">{{ $stats['active_sites'] }}</dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-gray-600">{{ __('Cultural Heritage Categories') }}</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">{{ $stats['total_categories'] }}</dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Popular Sites Section -->
    <div class="bg-gray-50 py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ __('Selected Cultural Sites') }}</h2>
                    <p class="mt-4 text-lg text-gray-600">{{ __('Some recommended cultural heritage sites that you can visit.') }}</p>
                </div>
                <a href="/heritage-sites" class="hidden sm:inline-flex items-center gap-1 text-sm font-semibold text-primary-600 hover:text-primary-500">
                    {{ __('View All') }}
                    <span aria-hidden="true">&rarr;</span>
                </a>
            </div>

            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
                @foreach ($popularSites as $site)
                    <a href="/heritage-sites/{{ $site->slug }}" class="group relative flex flex-col bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 overflow-hidden hover:shadow-lg transition duration-300">
                        <div class="aspect-[4/3] bg-gray-200 overflow-hidden relative">
                            @if ($site->photos->count() > 0)
                                <img src="{{ Storage::url($site->photos->first()->file_path) }}" alt="{{ $site->name }}" class="h-full w-full object-cover object-center group-hover:scale-105 transition duration-500">
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-gray-100 text-gray-400">
                                    <x-heroicon-o-photo class="w-12 h-12" />
                                </div>
                            @endif
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center rounded-md bg-white/90 backdrop-blur px-2 py-1 text-xs font-medium text-gray-800 ring-1 ring-inset ring-gray-200 shadow-sm">
                                    {{ $site->category?->name ?? __('Other') }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-lg font-bold text-gray-900 line-clamp-1 mb-2 group-hover:text-primary-600 transition">
                                {{ $site->name }}
                            </h3>
                            <p class="text-sm text-gray-500 line-clamp-2 mb-4 flex-1">
                                {{ strip_tags($site->description) }}
                            </p>
                            <div class="flex items-center gap-2 text-sm text-gray-500 mt-auto pt-4 border-t border-gray-100">
                                <x-heroicon-m-map-pin class="w-4 h-4 text-gray-400" />
                                <span class="truncate">{{ $site->address }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            
            <div class="mt-10 sm:hidden">
                <a href="/heritage-sites" class="block w-full rounded-lg bg-white px-4 py-3 text-center text-sm font-semibold text-primary-600 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    {{ __('View All Sites') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Map Placeholder Section -->
    <div class="bg-white py-16 sm:py-24 border-t border-gray-100">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ __('Cultural Heritage Location Map') }}</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">{{ __('Find the locations of cultural heritage scattered across the D.I. Yogyakarta region easily through our interactive map.') }}</p>
            </div>
            
            <div class="bg-gray-100 rounded-2xl overflow-hidden shadow-inner ring-1 ring-inset ring-gray-200 w-full relative">
                <x-leaflet-map :sites="$popularSites" height="500px" :interactive="false" />
                <div class="absolute inset-0 z-20 pointer-events-none flex items-center justify-center opacity-0 hover:opacity-100 transition duration-300">
                    <a href="/heritage-sites" class="pointer-events-auto bg-gray-900/80 backdrop-blur-sm text-white px-6 py-3 rounded-full font-medium hover:bg-gray-900 transition shadow-xl">
                        {{ __('Explore Full Map') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
