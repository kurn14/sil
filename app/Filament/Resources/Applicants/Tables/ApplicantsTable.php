<?php

namespace App\Filament\Resources\Applicants\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ApplicantsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('phone_number')
                    ->searchable(),
                TextColumn::make('nik')
                    ->searchable(),
                TextColumn::make('institution_name')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                \Filament\Actions\Action::make('export_excel')
                    ->label(__('Export Excel'))
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(fn () => \App\Lib\ApplicantExcelExporter::downloadExcel()),
                \Filament\Actions\Action::make('export_pdf')
                    ->label(__('Export PDF'))
                    ->icon('heroicon-o-document-text')
                    ->color('danger')
                    ->action(fn () => \App\Lib\ApplicantPdfExporter::downloadPdf()),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
