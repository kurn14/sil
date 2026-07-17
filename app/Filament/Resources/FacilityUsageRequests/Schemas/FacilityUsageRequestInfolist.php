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
                TextEntry::make('request_number'),
                TextEntry::make('user.name')
                    ->label(__('Applicant name')),
                TextEntry::make('site.name')
                    ->label(__('Heritage site')),
                TextEntry::make('applicant_name'),
                TextEntry::make('identity_number'),
                TextEntry::make('institution_name')
                    ->placeholder('-'),
                TextEntry::make('activity_type'),
                TextEntry::make('activity_description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('start_date')
                    ->date(),
                TextEntry::make('end_date')
                    ->date(),
                TextEntry::make('duration_days')
                    ->suffix(' hari'),
                TextEntry::make('participant_count')
                    ->suffix(' orang'),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('approval_notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('permit_number')
                    ->placeholder('-'),
                TextEntry::make('fee_amount')
                    ->money('IDR'),
                TextEntry::make('reviewer.name')
                    ->label(__('Reviewed by'))
                    ->placeholder('-'),
                TextEntry::make('reviewed_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
