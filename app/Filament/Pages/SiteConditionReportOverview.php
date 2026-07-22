<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use App\Models\SiteConditionReport;

class SiteConditionReportOverview extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationLabel = 'Ringkasan Laporan Kondisi';

    protected static ?string $title = 'Ringkasan Laporan Kondisi Situs';

    protected string $view = 'filament.pages.site-condition-report-overview';

    public function table(Table $table): Table
    {
        return $table
            ->query(SiteConditionReport::query()->latest('created_at'))
            ->columns([
                TextColumn::make('site.name')
                    ->label(__('Heritage site'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('surveyor.name')
                    ->label(__('Surveyor'))
                    ->searchable(),
                TextColumn::make('survey_date')
                    ->label(__('Survey date'))
                    ->date()
                    ->sortable(),
                TextColumn::make('condition')
                    ->label(__('Condition'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'good' => 'success',
                        'minor_damage' => 'warning',
                        'moderate_damage' => 'danger',
                        'severe_damage' => 'danger',
                        default => 'gray',
                    }),
                IconColumn::make('is_urgent')
                    ->label(__('Urgent'))
                    ->boolean(),
                TextColumn::make('respondedBy.name')
                    ->label(__('Responded by'))
                    ->searchable(),
            ]);
    }
}
