<?php

namespace App\Filament\Resources\ConditionReportPhotos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ConditionReportPhotoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('site_condition_report_id')
                    ->relationship('report', 'id')
                    ->required(),
                FileUpload::make('file_path')
                    ->image()
                    ->directory('condition-report-photos')
                    ->required(),
                TextInput::make('caption'),
            ]);
    }
}
