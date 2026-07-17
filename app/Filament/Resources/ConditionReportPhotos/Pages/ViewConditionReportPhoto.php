<?php

namespace App\Filament\Resources\ConditionReportPhotos\Pages;

use App\Filament\Resources\ConditionReportPhotos\ConditionReportPhotoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewConditionReportPhoto extends ViewRecord
{
    protected static string $resource = ConditionReportPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
