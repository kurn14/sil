<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\HeritageSite;

class HeritageSiteDetail extends Component
{
    public HeritageSite $site;
    public $relatedSites;

    public function mount($slug)
    {
        $this->site = HeritageSite::with(['category', 'photos'])->where('slug', $slug)->firstOrFail();
        
        $this->relatedSites = HeritageSite::with(['category', 'photos'])
            ->where('site_category_id', $this->site->site_category_id)
            ->where('id', '!=', $this->site->id)
            ->where('status', 'active')
            ->take(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.heritage-site-detail')
            ->title($this->site->name . ' - Katalog Situs Cagar Budaya');
    }
}
