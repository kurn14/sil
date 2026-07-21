<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumb -->
    <nav class="flex text-sm text-gray-500 mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/" class="inline-flex items-center hover:text-primary-600 transition">
                    <x-heroicon-s-home class="w-4 h-4 mr-2" />
                    {{ __('Home') }}
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="w-4 h-4 mx-1" />
                    <a href="/heritage-sites" class="hover:text-primary-600 transition">{{ __('Site Catalog') }}</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center text-gray-900 font-medium">
                    <x-heroicon-s-chevron-right class="w-4 h-4 mx-1 text-gray-500" />
                    {{ $site->name }}
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Header -->
            <div>
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <span class="inline-flex items-center rounded-md bg-white px-2.5 py-1 text-sm font-medium text-gray-800 ring-1 ring-inset ring-gray-300 shadow-sm">
                        {{ $site->category?->name ?? __('Other Category') }}
                    </span>
                    
                    @php
                        $statusColors = [
                            'active' => 'bg-green-50 text-green-700 ring-green-600/20',
                            'under_renovation' => 'bg-amber-50 text-amber-700 ring-amber-600/20',
                            'temporarily_closed' => 'bg-red-50 text-red-700 ring-red-600/10',
                        ];
                        $statusLabels = [
                            'active' => __('Actively Visited'),
                            'under_renovation' => __('Under Renovation'),
                            'temporarily_closed' => __('Temporarily Closed'),
                        ];
                        $colorClass = $statusColors[$site->status] ?? 'bg-gray-50 text-gray-700 ring-gray-600/20';
                        $label = $statusLabels[$site->status] ?? ucfirst($site->status);
                    @endphp
                    <span class="inline-flex items-center rounded-md px-2.5 py-1 text-sm font-medium ring-1 ring-inset {{ $colorClass }}">
                        {{ $label }}
                    </span>
                </div>
                
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 tracking-tight">{{ $site->name }}</h1>
                <div class="mt-4 flex items-start gap-2 text-gray-600">
                    <x-heroicon-m-map-pin class="w-5 h-5 shrink-0 mt-0.5" />
                    <span>{{ $site->address }}</span>
                </div>
            </div>

            <!-- Photo Gallery -->
            @if($site->photos->count() > 0)
                <div x-data="{ 
                        activeSlide: 1, 
                        slides: {{ $site->photos->count() }},
                        next() { this.activeSlide = this.activeSlide === this.slides ? 1 : this.activeSlide + 1 },
                        prev() { this.activeSlide = this.activeSlide === 1 ? this.slides : this.activeSlide - 1 }
                    }" 
                    class="relative w-full rounded-2xl overflow-hidden bg-gray-100 ring-1 ring-inset ring-gray-200 shadow-sm aspect-video mb-8 group">
                    
                    <!-- Slides -->
                    <div class="relative w-full h-full">
                        @foreach($site->photos as $index => $photo)
                            <div x-show="activeSlide === {{ $index + 1 }}" 
                                 x-transition.opacity.duration.300ms
                                 class="absolute inset-0">
                                <img src="{{ Storage::url($photo->file_path) }}" alt="{{ $site->name }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                    
                    @if($site->photos->count() > 1)
                        <!-- Prev/Next Buttons -->
                        <button type="button" @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/70 hover:bg-white text-gray-800 shadow backdrop-blur flex items-center justify-center transition opacity-0 group-hover:opacity-100 focus:opacity-100">
                            <x-heroicon-m-chevron-left class="w-6 h-6" />
                        </button>
                        <button type="button" @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/70 hover:bg-white text-gray-800 shadow backdrop-blur flex items-center justify-center transition opacity-0 group-hover:opacity-100 focus:opacity-100">
                            <x-heroicon-m-chevron-right class="w-6 h-6" />
                        </button>

                        <!-- Indicators -->
                        <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2 z-10">
                            @foreach($site->photos as $index => $photo)
                                <button type="button" @click="activeSlide = {{ $index + 1 }}" 
                                        :class="activeSlide === {{ $index + 1 }} ? 'bg-white w-6' : 'bg-white/50 w-2 hover:bg-white/80'" 
                                        class="h-2 rounded-full transition-all duration-300 shadow-sm"></button>
                            @endforeach
                        </div>
                    @endif
                </div>
            @else
                <div class="aspect-video rounded-2xl bg-gray-100 ring-1 ring-inset ring-gray-200 flex items-center justify-center mb-8">
                    <div class="text-center text-gray-400">
                        <x-heroicon-o-photo class="w-16 h-16 mx-auto mb-2" />
                        <p>{{ __('No photos available yet') }}</p>
                    </div>
                </div>
            @endif

            <!-- Description -->
            <div class="prose prose-primary max-w-none prose-lg text-gray-700 bg-white p-6 sm:p-8 rounded-2xl shadow-sm ring-1 ring-gray-200">
                <h2 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2">{{ __('Description') }}</h2>
                {!! nl2br(e($site->description)) !!}
            </div>
            
            <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm ring-1 ring-gray-200">
                <h2 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2">{{ __('Map Location') }}</h2>
                <div class="bg-gray-100 rounded-xl overflow-hidden relative ring-1 ring-inset ring-gray-200">
                    <x-leaflet-map :sites="collect([$site])" height="300px" :interactive="true" :zoom="14" :center="['lat' => $site->latitude ?? -7.7956, 'lng' => $site->longitude ?? 110.3695]" />
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-6">
            <!-- Info Card -->
            <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 overflow-hidden sticky top-24">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">{{ __('Site Information') }}</h3>
                    
                    <dl class="space-y-4 text-sm">
                        @if($site->registration_number)
                        <div>
                            <dt class="text-gray-500 font-medium">{{ __('National Registration Number') }}</dt>
                            <dd class="mt-1 text-gray-900">{{ $site->registration_number }}</dd>
                        </div>
                        @endif
                        
                        @if($site->designation_year)
                        <div>
                            <dt class="text-gray-500 font-medium">{{ __('Designation Year') }}</dt>
                            <dd class="mt-1 text-gray-900">{{ $site->designation_year }}</dd>
                        </div>
                        @endif
                        
                        @if($site->operating_hours && is_array($site->operating_hours) && count($site->operating_hours) > 0)
                        <div>
                            <dt class="text-gray-500 font-medium mb-2">{{ __('Operating Hours') }}</dt>
                            <dd class="mt-1">
                                <ul class="space-y-2 bg-gray-50 p-3 rounded-lg ring-1 ring-inset ring-gray-200">
                                    @foreach($site->operating_hours as $hours)
                                        <li class="flex justify-between border-b border-gray-200 last:border-0 pb-2 last:pb-0">
                                            <span class="text-gray-600 font-medium capitalize">{{ $hours['day'] ?? '-' }}</span>
                                            <span class="text-gray-900">
                                                @if(isset($hours['is_closed']) && $hours['is_closed'])
                                                    <span class="text-red-600 font-medium">{{ __('Closed') }}</span>
                                                @else
                                                    {{ $hours['open_time'] ?? '' }} - {{ $hours['close_time'] ?? '' }}
                                                @endif
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </dd>
                        </div>
                        @endif
                    </dl>
                </div>
                
                @if($site->is_facility_available && $site->status === 'active')
                    <div class="p-6 bg-primary-50 border-t border-primary-100">
                        <h4 class="font-bold text-primary-900 mb-2">{{ __('Use This Site\'s Facilities') }}</h4>
                        <p class="text-sm text-primary-700 mb-4">{{ __('You can submit an application for cultural activities, research, or documentation.') }}</p>
                        <a href="/applicant/facility-usage-requests/create?site={{ $site->id }}" class="flex justify-center items-center gap-2 w-full rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 transition">
                            <x-heroicon-s-document-text class="w-4 h-4" />
                            {{ __('Submit Application') }}
                        </a>
                    </div>
                @elseif($site->is_facility_available)
                    <div class="p-6 bg-amber-50 border-t border-amber-100">
                        <div class="flex gap-3 text-amber-800">
                            <x-heroicon-s-exclamation-triangle class="w-5 h-5 shrink-0" />
                            <p class="text-sm">{{ __('Facilities cannot be used at this time due to site status:') }} <strong>{{ $label }}</strong>.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Sites -->
    @if($relatedSites && $relatedSites->count() > 0)
    <div class="mt-20 pt-10 border-t border-gray-200">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">{{ __('Other Recommendations') }}</h2>
        <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
            @foreach ($relatedSites as $relatedSite)
                <a href="/heritage-sites/{{ $relatedSite->slug }}" class="group relative flex flex-col bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 overflow-hidden hover:shadow-lg transition duration-300 h-full">
                    <div class="aspect-[4/3] bg-gray-200 overflow-hidden relative">
                        @if ($relatedSite->photos->count() > 0)
                            <img src="{{ Storage::url($relatedSite->photos->first()->file_path) }}" alt="{{ $relatedSite->name }}" class="h-full w-full object-cover object-center group-hover:scale-105 transition duration-500">
                        @else
                            <div class="h-full w-full flex items-center justify-center bg-gray-100 text-gray-400">
                                <x-heroicon-o-photo class="w-12 h-12" />
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center rounded-md bg-white/90 backdrop-blur px-2 py-1 text-xs font-medium text-gray-800 ring-1 ring-inset ring-gray-200 shadow-sm">
                                {{ $relatedSite->category?->name ?? __('Other') }}
                            </span>
                        </div>
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <h3 class="text-lg font-bold text-gray-900 line-clamp-1 mb-2 group-hover:text-primary-600 transition">
                            {{ $relatedSite->name }}
                        </h3>
                        <div class="flex items-start gap-2 text-sm text-gray-500 mt-auto pt-4 border-t border-gray-100">
                            <x-heroicon-m-map-pin class="w-4 h-4 text-gray-400 shrink-0 mt-0.5" />
                            <span class="line-clamp-2">{{ $relatedSite->address }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
