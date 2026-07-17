<?php

namespace App\Filament\Resources\SitePhotos\Pages;

use App\Filament\Resources\SitePhotos\SitePhotoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSitePhoto extends EditRecord
{
    protected static string $resource = SitePhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
