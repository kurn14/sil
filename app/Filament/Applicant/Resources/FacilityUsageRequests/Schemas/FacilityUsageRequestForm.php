<?php

namespace App\Filament\Applicant\Resources\FacilityUsageRequests\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use App\Models\HeritageSite;

class FacilityUsageRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('applicant_id')
                    ->default(fn () => auth()->id()),
                Hidden::make('request_number')
                    ->default(fn () => 'REQ-' . strtoupper(Str::random(8))),
                Select::make('heritage_site_id')
                    ->label(__('Heritage site'))
                    ->options(HeritageSite::where('is_facility_available', true)->where('status', 'active')->pluck('name', 'id'))
                    ->default(request()->query('site'))
                    ->required(),
                TextInput::make('identity_number')
                    ->label(__('Identity number (NIK)'))
                    ->length(16)
                    ->numeric()
                    ->required(),
                TextInput::make('institution_name')
                    ->label(__('Institution name'))
                    ->default(fn () => auth()->user()->institution_name),
                TextInput::make('activity_type')
                    ->label(__('Activity type'))
                    ->required(),
                Textarea::make('activity_description')
                    ->label(__('Activity description'))
                    ->columnSpanFull(),
                DatePicker::make('start_date')
                    ->label(__('Start date'))
                    ->required(),
                DatePicker::make('end_date')
                    ->label(__('End date'))
                    ->required(),
                TextInput::make('duration_days')
                    ->label(__('Duration days'))
                    ->numeric(),
                TextInput::make('participant_count')
                    ->label(__('Participant count'))
                    ->numeric(),
                FileUpload::make('application_letter_path')
                    ->label(__('Application letter'))
                    ->directory('application-letters')
                    ->acceptedFileTypes(['application/pdf'])
                    ->required()
                    ->maxSize(5120), // 5MB max
            ]);
    }
}
