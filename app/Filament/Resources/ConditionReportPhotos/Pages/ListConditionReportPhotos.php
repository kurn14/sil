<?php

namespace App\Filament\Resources\ConditionReportPhotos\Pages;

use App\Filament\Resources\ConditionReportPhotos\ConditionReportPhotoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConditionReportPhotos extends ListRecords
{
    protected static string $resource = ConditionReportPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
