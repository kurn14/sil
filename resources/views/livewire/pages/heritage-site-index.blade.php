<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">{{ __('Cultural Heritage Site Catalog') }}</h1>
        <p class="mt-2 text-lg text-gray-600">{{ __('Explore various cultural heritage scattered across the D.I. Yogyakarta region.') }}</p>
    </div>

    <!-- Filters and Controls -->
    <div class="bg-white p-4 rounded-xl shadow-sm ring-1 ring-gray-200 mb-8 flex flex-col sm:flex-row gap-4 items-center justify-between">
        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto flex-1">
            <!-- Search -->
            <div class="relative w-full sm:max-w-xs">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <x-heroicon-m-magnifying-glass class="h-5 w-5 text-gray-400" />
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" class="block w-full rounded-md border-0 py-2 pl-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6" placeholder="{{ __('Search name or location...') }}">
            </div>

            <!-- Category Filter -->
            <select wire:model.live="categoryId" class="block w-full sm:max-w-xs rounded-md border-0 py-2 pl-3 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6">
                <option value="">{{ __('All Categories') }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <!-- Status Filter -->
            <select wire:model.live="status" class="block w-full sm:max-w-xs rounded-md border-0 py-2 pl-3 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6">
                <option value="">{{ __('All Statuses') }}</option>
                <option value="active">{{ __('Actively Visited') }}</option>
                <option value="under_renovation">{{ __('Under Renovation') }}</option>
                <option value="temporarily_closed">{{ __('Temporarily Closed') }}</option>
            </select>
        </div>

        <!-- View Mode Toggle -->
        <div class="flex items-center rounded-md shadow-sm ring-1 ring-inset ring-gray-300 shrink-0 w-full sm:w-auto">
            <button wire:click="$set('viewMode', 'grid')" type="button" class="relative inline-flex w-1/2 sm:w-auto justify-center items-center rounded-l-md px-3 py-2 text-sm font-semibold {{ $viewMode === 'grid' ? 'bg-primary-50 text-primary-600 z-10 ring-1 ring-inset ring-primary-600' : 'bg-white text-gray-900 hover:bg-gray-50' }}">
                <x-heroicon-m-squares-2x2 class="h-5 w-5 mr-2" />
                {{ __('Grid') }}
            </button>
            <button wire:click="$set('viewMode', 'map')" type="button" class="relative -ml-px inline-flex w-1/2 sm:w-auto justify-center items-center rounded-r-md px-3 py-2 text-sm font-semibold {{ $viewMode === 'map' ? 'bg-primary-50 text-primary-600 z-10 ring-1 ring-inset ring-primary-600' : 'bg-white text-gray-900 hover:bg-gray-50' }}">
                <x-heroicon-m-map class="h-5 w-5 mr-2" />
                {{ __('Map') }}
            </button>
        </div>
    </div>

    <!-- Content Area -->
    <div class="relative min-h-[400px]">
        
        <!-- Loading overlay -->
        <div wire:loading.flex class="absolute inset-0 bg-white/80 backdrop-blur-sm z-20 items-center justify-center rounded-xl">
            <div class="flex items-center gap-3 text-primary-600 font-medium">
                <svg class="animate-spin h-8 w-8 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ __('Loading data...') }}
            </div>
        </div>

        @if($viewMode === 'grid')
            <!-- {{ __('Grid') }} View -->
            @if($sites->count() > 0)
                <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                    @foreach ($sites as $site)
                        <a href="/heritage-sites/{{ $site->slug }}" class="group relative flex flex-col bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 overflow-hidden hover:shadow-lg transition duration-300 h-full">
                            <div class="aspect-[4/3] bg-gray-200 overflow-hidden relative">
                                @if ($site->photos->count() > 0)
                                    <img src="{{ Storage::url($site->photos->first()->file_path) }}" alt="{{ $site->name }}" class="h-full w-full object-cover object-center group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="h-full w-full flex items-center justify-center bg-gray-100 text-gray-400">
                                        <x-heroicon-o-photo class="w-12 h-12" />
                                    </div>
                                @endif
                                
                                <div class="absolute top-4 left-4 flex flex-col gap-2">
                                    <span class="inline-flex items-center rounded-md bg-white/90 backdrop-blur px-2 py-1 text-xs font-medium text-gray-800 ring-1 ring-inset ring-gray-200 shadow-sm">
                                        {{ $site->category?->name ?? __('Other') }}
                                    </span>
                                    
                                    @php
                                        $statusColors = [
                                            'active' => 'bg-green-50 text-green-700 ring-green-600/20',
                                            'under_renovation' => 'bg-amber-50 text-amber-700 ring-amber-600/20',
                                            'temporarily_closed' => 'bg-red-50 text-red-700 ring-red-600/10',
                                        ];
                                        $statusLabels = [
                                            'active' => __('Active'),
                                            'under_renovation' => __('Renovation'),
                                            'temporarily_closed' => __('Closed'),
                                        ];
                                        $colorClass = $statusColors[$site->status] ?? 'bg-gray-50 text-gray-700 ring-gray-600/20';
                                        $label = $statusLabels[$site->status] ?? ucfirst($site->status);
                                    @endphp
                                    <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $colorClass }}">
                                        {{ $label }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-5 flex-1 flex flex-col">
                                <h3 class="text-lg font-bold text-gray-900 line-clamp-1 mb-2 group-hover:text-primary-600 transition">
                                    {{ $site->name }}
                                </h3>
                                <div class="flex items-start gap-2 text-sm text-gray-500 mt-auto pt-4 border-t border-gray-100">
                                    <x-heroicon-m-map-pin class="w-4 h-4 text-gray-400 shrink-0 mt-0.5" />
                                    <span class="line-clamp-2">{{ $site->address }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                
                <div class="mt-10">
                    {{ $sites->links() }}
                </div>
            @else
                <div class="text-center py-24 bg-white rounded-2xl ring-1 ring-inset ring-gray-200">
                    <x-heroicon-o-magnifying-glass class="mx-auto h-12 w-12 text-gray-400" />
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">{{ __('No sites found') }}</h3>
                    <p class="mt-1 text-sm text-gray-500">{{ __('Try adjusting your search keywords or filters.') }}</p>
                    <div class="mt-6">
                        <button wire:click="$set('search', ''); $set('categoryId', ''); $set('status', '')" type="button" class="inline-flex items-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">
                            {{ __('Reset Filter') }}
                        </button>
                    </div>
                </div>
            @endif
        @else
            <!-- Map View -->
            <div class="bg-gray-100 rounded-2xl overflow-hidden shadow-inner ring-1 ring-inset ring-gray-200 w-full relative">
                <x-leaflet-map :sites="$allSites" height="600px" :interactive="true" />
            </div>
            <p class="text-sm text-gray-500 mt-3 text-center">{{ __('Found :count cultural heritage locations based on the current filters.', ['count' => $allSites->count()]) }}</p>
        @endif
    </div>
</div>
