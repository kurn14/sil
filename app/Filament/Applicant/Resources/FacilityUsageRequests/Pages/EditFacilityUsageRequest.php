<?php

namespace App\Filament\Applicant\Resources\FacilityUsageRequests\Pages;

use App\Filament\Applicant\Resources\FacilityUsageRequests\FacilityUsageRequestResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditFacilityUsageRequest extends EditRecord
{
    protected static string $resource = FacilityUsageRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
