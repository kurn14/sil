<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\HeritageSite;
use App\Models\SiteCategory;

class Home extends Component
{
    public function render()
    {
        $stats = [
            'total_sites' => HeritageSite::count(),
            'total_categories' => SiteCategory::count(),
            'active_sites' => HeritageSite::where('status', 'active')->count(),
        ];

        $popularSites = HeritageSite::with(['category', 'photos'])
            ->where('status', 'active')
            ->latest()
            ->take(6)
            ->get();

        return view('livewire.pages.home', [
            'stats' => $stats,
            'popularSites' => $popularSites,
        ]);
    }
}
