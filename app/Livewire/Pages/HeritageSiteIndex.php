<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\HeritageSite;
use App\Models\SiteCategory;

class HeritageSiteIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryId = '';
    public $status = '';
    
    // Toggles between grid and map view
    public $viewMode = 'grid'; // grid, map

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryId' => ['except' => ''],
        'status' => ['except' => ''],
        'viewMode' => ['except' => 'grid'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryId()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = HeritageSite::with(['category', 'photos']);

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('address', 'like', '%' . $this->search . '%');
        }

        if ($this->categoryId) {
            $query->where('site_category_id', $this->categoryId);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return view('livewire.pages.heritage-site-index', [
            'sites' => $query->latest()->paginate(12),
            'categories' => SiteCategory::all(),
            'allSites' => $this->viewMode === 'map' ? $query->get() : collect(), // For map view
        ]);
    }
}
