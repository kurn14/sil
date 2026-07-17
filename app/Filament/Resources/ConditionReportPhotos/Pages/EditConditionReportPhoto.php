<?php

namespace App\Filament\Resources\ConditionReportPhotos\Pages;

use App\Filament\Resources\ConditionReportPhotos\ConditionReportPhotoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditConditionReportPhoto extends EditRecord
{
    protected static string $resource = ConditionReportPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
