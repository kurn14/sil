<?php

namespace App\Filament\Resources\FacilityUsageRequests\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FacilityUsageRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('request_number')
                    ->label(__('Request number'))
                    ->required(),
                Select::make('user_id')
                    ->label(__('User'))
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('heritage_site_id')
                    ->label(__('Heritage site'))
                    ->relationship('site', 'name', fn ($query) => $query->reorder()->orderByRaw("name->>'" . app()->getLocale() . "' ASC"))
                    ->required(),
                TextInput::make('applicant_name')
                    ->label(__('Applicant name'))
                    ->required(),
                TextInput::make('identity_number')
                    ->label(__('Identity number'))
                    ->required(),
                TextInput::make('institution_name')
                    ->label(__('Institution name')),
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
                    ->directory('application-letters'),
                Select::make('status')
                    ->label(__('Status'))
                    ->options([
                        'submitted' => __('Submitted'),
                        'verified' => __('Verified'),
                        'approved' => __('Approved'),
                        'rejected' => __('Rejected'),
                        'completed' => __('Completed'),
                        'cancelled' => __('Cancelled'),
                    ])
                    ->default('submitted')
                    ->required(),
                Textarea::make('approval_notes')
                    ->label(__('Approval notes'))
                    ->columnSpanFull(),
                TextInput::make('permit_number')
                    ->label(__('Permit number')),
                TextInput::make('fee_amount')
                    ->label(__('Fee amount'))
                    ->numeric()
                    ->default(0),
                Select::make('reviewed_by')
                    ->label(__('Reviewed by'))
                    ->relationship('reviewer', 'name'),
            ]);
    }
}
