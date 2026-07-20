<?php

namespace App\Filament\Resources\FacilityUsageRequests\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FacilityUsageRequestInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('request_number')
                    ->label(__('Request number')),
                TextEntry::make('user.name')
                    ->label(__('Applicant name')),
                TextEntry::make('site.name')
                    ->label(__('Heritage site')),
                TextEntry::make('applicant_name')
                    ->label(__('Applicant name')),
                TextEntry::make('identity_number')
                    ->label(__('Identity number')),
                TextEntry::make('institution_name')
                    ->label(__('Institution name'))
                    ->placeholder('-'),
                TextEntry::make('activity_type')
                    ->label(__('Activity type')),
                TextEntry::make('activity_description')
                    ->label(__('Activity description'))
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('start_date')
                    ->label(__('Start date'))
                    ->date(),
                TextEntry::make('end_date')
                    ->label(__('End date'))
                    ->date(),
                TextEntry::make('duration_days')
                    ->label(__('Duration days'))
                    ->suffix(' hari'),
                TextEntry::make('participant_count')
                    ->label(__('Participant count'))
                    ->suffix(' orang'),
                TextEntry::make('status')
                    ->label(__('Status'))
                    ->badge(),
                TextEntry::make('approval_notes')
                    ->label(__('Approval notes'))
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('permit_number')
                    ->label(__('Permit number'))
                    ->placeholder('-'),
                TextEntry::make('fee_amount')
                    ->label(__('Fee amount'))
                    ->money('IDR'),
                TextEntry::make('reviewer.name')
                    ->label(__('Reviewed by'))
                    ->placeholder('-'),
                TextEntry::make('reviewed_at')
                    ->label(__('Reviewed at'))
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label(__('Updated at'))
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
