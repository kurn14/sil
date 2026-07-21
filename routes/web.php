<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Pages\Home;
use App\Livewire\Pages\HeritageSiteIndex;
use App\Livewire\Pages\HeritageSiteDetail;
use Illuminate\Support\Facades\Session;

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
});

Route::get('/', Home::class);
Route::get('/heritage-sites', HeritageSiteIndex::class);
Route::get('/heritage-sites/{slug}', HeritageSiteDetail::class);
