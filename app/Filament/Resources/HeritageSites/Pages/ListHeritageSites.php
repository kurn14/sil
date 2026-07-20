<?php

namespace App\Filament\Resources\HeritageSites\Pages;

use App\Filament\Resources\HeritageSites\HeritageSiteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;

class ListHeritageSites extends ListRecords
{
    use Translatable;

    protected static string $resource = HeritageSiteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            CreateAction::make(),
        ];
    }
}
