<?php

namespace App\Filament\Resources\SiteConditionReports\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SiteConditionReportInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('site.name')
                    ->label(__('Heritage site')),
                TextEntry::make('surveyor.name')
                    ->label(__('Surveyor')),
                TextEntry::make('survey_date')
                    ->label(__('Survey date'))
                    ->date(),
                TextEntry::make('condition')
                    ->label(__('Condition'))
                    ->badge(),
                TextEntry::make('findings')
                    ->label(__('Findings'))
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('recommendation')
                    ->label(__('Recommendation'))
                    ->placeholder('-')
                    ->columnSpanFull(),
                IconEntry::make('is_urgent')
                    ->label(__('Is urgent'))
                    ->boolean(),
                TextEntry::make('responder.name')
                    ->label(__('Responded by'))
                    ->placeholder('-'),
                TextEntry::make('responded_at')
                    ->label(__('Responded at'))
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('response_notes')
                    ->label(__('Response notes'))
                    ->placeholder('-')
                    ->columnSpanFull(),
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
