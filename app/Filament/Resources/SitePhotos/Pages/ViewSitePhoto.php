<?php

namespace App\Filament\Resources\SitePhotos\Pages;

use App\Filament\Resources\SitePhotos\SitePhotoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSitePhoto extends ViewRecord
{
    protected static string $resource = SitePhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
