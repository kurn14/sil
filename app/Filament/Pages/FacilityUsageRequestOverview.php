<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Models\FacilityUsageRequest;

class FacilityUsageRequestOverview extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Ringkasan Pemakaian';

    protected static ?string $title = 'Ringkasan Pemakaian Fasilitas';

    protected string $view = 'filament.pages.facility-usage-request-overview';

    public function table(Table $table): Table
    {
        return $table
            ->query(FacilityUsageRequest::query()->latest('created_at'))
            ->columns([
                TextColumn::make('request_number')
                    ->label(__('Request number'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('applicant.name')
                    ->label(__('Applicant'))
                    ->searchable(),
                TextColumn::make('site.name')
                    ->label(__('Heritage site'))
                    ->searchable(),
                TextColumn::make('activity_type')
                    ->label(__('Activity type'))
                    ->searchable(),
                TextColumn::make('start_date')
                    ->label(__('Start date'))
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label(__('End date'))
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'submitted' => 'gray',
                        'verified' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        'completed' => 'primary',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
            ]);
    }
}
