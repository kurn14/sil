<?php

namespace App\Filament\Resources\HeritageSites\Pages;

use App\Filament\Resources\HeritageSites\HeritageSiteResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use LaraZeus\SpatieTranslatable\Resources\Pages\ViewRecord\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;

class ViewHeritageSite extends ViewRecord
{
    use Translatable;

    protected static string $resource = HeritageSiteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            EditAction::make(),
        ];
    }
}
