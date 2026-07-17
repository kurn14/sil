<?php

namespace App\Filament\Resources\SitePhotos\Pages;

use App\Filament\Resources\SitePhotos\SitePhotoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSitePhotos extends ListRecords
{
    protected static string $resource = SitePhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
