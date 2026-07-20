<?php

namespace App\Filament\Resources\FacilityUsageRequests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FacilityUsageRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('request_number')
                    ->label(__('Request number'))
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label(__('Applicant name'))
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
                    ->searchable(),
                TextColumn::make('fee_amount')
                    ->label(__('Fee amount'))
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('Updated at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
